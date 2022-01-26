<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'users';

    public $timestamps = true;

    static $rules = [
      //'name' => 'required',
      'email' => 'required|email',
      'ime' => 'required',
      'prezime' => 'required',
      'oib' => 'required|max:13',
      'mobitel' => 'required|max:12',
      'dat_god_rodenja' => 'required|date',
      //'ulica' => 'nullable',
      //'kucni_broj' => 'nullable',
      //'mjesto' => 'nullable',
      //'postanski_broj' => 'nullable',
      //'mjesto_id' => 'nullable|int|exists:mjesta,id',
      //'drzava_id' => 'required|int|exists:drzave,id',
      'is_posjetitelj' => 'nullable|int',
      'is_administracija' => 'nullable|int'
      //'zadnjeaktivan_at' => 'nullable'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dat_god_rodenja' => 'date',
        'email_verified_at' => 'datetime',
        'is_posjetitelj' => 'boolean',
        'is_administracija' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'name',
      'email',
      'password',
      'ime',
      'prezime',
      'oib',
      'mobitel',
      'dat_god_rodenja',
      //'ulica',
      //'kucni_broj',
      //'mjesto',
      //'postanski_broj',
      //'drzava_id',
      'is_posjetitelj',
      'is_administracija'
      //'zadnjeaktivan_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
    * Ovisno o postavkama par polja vraca array uloga koje ova osoba ima.
    * Posjetitelj - ovo je posjetitelj
    * Administracija - ovo su administrativne osobe koje upravljaju sifarnicima
    * @return array ['predavac','student','administracija']
    */
    public function calc_uloge() : array
    {
      $roles = [];
      if($this->is_posjetitelj && !$this->is_administracija)
        $roles[] = 'posjetitelj';
      if(!$this->is_posjetitelj && !$this->is_administracija)
        $roles[] = 'zaposlenik';
      if($this->hasAdminAccess())
        $roles[] = 'administracija';
      return $roles;
    }

    public function getAvatarUrlAttribute()
    {
      $avatar_path = Storage::disk('public')->path('avatars/'.$this->id.'.jpg');
      if(is_file($avatar_path))
        return '/storage/avatars/'.$this->id.'.jpg?v'.$this->updated_at->timestamp;

      return '/res/img/avatar.png';
    }

    /**
    * ->uloge
    */
    public function getUlogeAttribute()
    {
      return $this->calc_uloge();
    }

    /**
    * ->puno_prezime_ime
    */
    public function getPunoPrezimeImeAttribute()
    {
      $r = $this->prezime. ' ' . $this->ime;

      return \trim($r);
    }

    /**
    * ->adresa
    */
    /*public function getAdresaAttribute()
    {
      $r = '';
      if(!empty($this->ulica))
      {
        $r .= $this->ulica.' '.$this->kucni_broj." \n";
      }
      else
      {
        $r .= "- \n";
      }
      if(!empty($this->mjesto))
      {
        $r .= $this->postanski_broj.' '.$this->mjesto.', ';
      }
      else
      {
        $r .= "-, ";
      }
      if($this->drzava_id)
        $r .= $this->drzava->naziv;
      return $r;
    }*/


    /**
    * Permissive strategy.
    * @param string $action - access(views list of models)|view(view model)|edit(edit form + update)|create(create form + store)|delete
    * @param string $modelname - User|Modelxy ...
    * @param nullable Model - laoded model instance when its available
    * @return boolean
    */
    public function canmodel($action,$modelname,$model = null) : bool
    {
      # Administrator moze sve
      if($this->hasAdminAccess())
        return true;

      # NON ADMINISTRATORS
      if($modelname == 'User')
      {
        //Special actions: view-details, edit-avatar
        if($action == 'view')
        {
          //svi mogu pogledati profile
          return true;
        }
        elseif($action == 'view-details')
        {
          if($model && $model->id == $this->id)
          {
            //ovaj korisnik moze vidjeti svoje informacije
            return true;
          }
          if(!$this->is_posjetitelj && !$this->is_administracija)
            return true; //zaposlenik moze svima vidjeti detaljne informacije
        }
        elseif($action == 'edit-avatar')
        {
          if($model && $model->id == $this->id)
          {
            if(!$this->is_posjetitelj && !$this->is_administracija)
              return true; //zaposlenik moze sebi urediti avatar
          }
        }
        elseif($action == 'access' || $action == 'create')
        {
          if(!$this->is_posjetitelj && !$this->is_administracija)
            return true; //zaposlenik moze sebi urediti avatar
        }
        elseif($action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
      }
      if($modelname == 'Genre') //GenreController
      {
        if($action == 'access' || $action == 'view')
        {
          if($this->hasAdminAccess() || (!$this->is_posjetitelj && !$this->is_administracija))
            return true; //voditelj i zaposlenik moze
        }
        elseif($action == 'create' || $action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
        else
        {
            //no action
        }
      }
      elseif($modelname == 'Hall')
      {
        if($action == 'access' || $action == 'view')
        {
          if($this->hasAdminAccess() || (!$this->is_posjetitelj && !$this->is_administracija))
            return true; //voditelj i zaposlenik moze
        }
        elseif($action == 'create' || $action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
        else
        {
            //no action
        }
      }
      elseif($modelname == 'Movie')
      {
        if($action == 'access' || $action == 'view')
        {
          if($this->hasAdminAccess() || (!$this->is_posjetitelj && !$this->is_administracija))
            return true; //voditelj i zaposlenik moze
        }
        elseif($action == 'create' || $action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
        else
        {
            //no action
        }
      }
      elseif($modelname == 'Seat')
      {
        if($action == 'access' || $action == 'view')
        {
          if($this->hasAdminAccess() || (!$this->is_posjetitelj && !$this->is_administracija))
            return true; //voditelj i zaposlenik moze
        }
        elseif($action == 'create' || $action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
        else
        {
            //no action
        }
      }
      elseif($modelname == 'Show')
      {
        if($action == 'access' || $action == 'view' || $action == 'create')
        {
          if($this->hasAdminAccess() || (!$this->is_posjetitelj && !$this->is_administracija))
            return true; //voditelj i zaposlenik moze
        }
        elseif($action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
        else
        {
            //no action
        }
      }
      elseif($modelname == 'Reservation')
      {
        if($action == 'access' || $action == 'view' || $action == 'create')
        {
          if($this->hasAdminAccess() || (!$this->is_posjetitelj && !$this->is_administracija))
            return true; //voditelj i zaposlenik moze
        }
        elseif($action == 'edit' || $action == 'delete')
        {
          if($this->hasAdminAccess())
            return true; //voditelj moze
        }
        else
        {
            //no action
        }
      }
      //dd($action,$modelname,$model);
      return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation', 'id', 'user_id');
    }

    public function deletecheck(): array
    {
      //$check_
      $r = [
        'can' => true,
        'message' => null
      ];

      $count_rezervacije = $this->reservations()->count();
      if($count_rezervacije)
      {
        $r['can'] = false;
        $r['message'] = 'Molim obrišite sve vezane rezervacije prije brisanja korisnika.';
        return $r;
      }

      return $r;
    }

    /**
    * Glavna funkcija za provjeru ima li admin pristup ili nema.
    * @return bool
    */
    public function hasAdminAccess() : bool
    {
      //return true;
      if($this->is_administracija && !$this->is_posjetitelj)
        return true;

      else
        return false;

      /*$check = Cache::get('adminaccess_'.$this->id);
      if($check == 1)
        return true;
      return false;*/
    }

    /**
    * Omogucava admin pristup na 60 min ovom korisniku.
    * @return void
    **/
    public function enableAdminAccess()
    {
      if(!$this->is_administracija)
        return;

      $this->disableAdminAccess(); //this will reset ttl

      $check = Cache::get('adminaccess_'.$this->id);
      if(empty($check))
      {
        Cache::put('adminaccess_'.$this->id,1,(config('kina.adminaccess_minutes')*60));
      }
    }

    /**
    * Onemogucava admin pristup na 60 min ovom korisniku, ako je omoguceno.
    * @return void
    **/
    public function disableAdminAccess()
    {
      $check = Cache::get('adminaccess_'.$this->id);
      if($check == 1)
      {
        Cache::forget('adminaccess_'.$this->id);
      }
    }

    public function getDisplayDateAttribute()
    {
      return $this->dat_god_rodenja->format(config('kina.datetime_date'));
    }

    # E - M A I L S
    # @see https://laravel.com/docs/8.x/mail

    /**
    * Posalji email dobrodoslice ovom korisniku na njegov email.
    * @param bool $doResetPassword - autmatski generira novi password i spremi na korisnika
    * @param bool $queue - true - salje preko queue sistema, false - salje odmah
    * @param string $queue_name - naziv queuea koji koristiti za slanje
    * @return void
    */
    /*public function sendWelcomeEmail(bool $doResetPassword = false, bool $queue = false, $queue_name = 'default')
    {
      $new_password = null;

      if($doResetPassword)
      {
        $new_password = \Illuminate\Support\Str::random(6);
        $new_password = \Illuminate\Support\Str::lower($new_password);
        //loadamo ga jer ne znamo sa sigurnoscu da ce stanje $this instance biti netaknuto.
        $_newlyloadeduser = User::findOrFail($this->id);
        $_newlyloadeduser->password = Hash::make($new_password);
        $_newlyloadeduser->save();
      }
      $message = new \App\Mail\Welcome($this,$new_password);
      if($queue)
      {
        $message = $message->onQueue($queue_name);
      }
      //send email
      if($queue)
        Mail::to($this->email)->queue($message);
      else
        Mail::to($this->email)->send($message);
    }*/
}
