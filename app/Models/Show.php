<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;

class Show extends Model
{
    use HasFactory;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'shows';

    public $timestamps = true;

    static $rules = [
  		'naziv' => 'required',
      'movie_id' => 'required|int|exists:movies,id',
      'hall_id' => 'required|int|exists:halls,id',
      'datum_i_vrijeme_odrzavanja' => 'nullable', //jer je saljemo ovako iz forme',
  		'trajanje' => 'required|int'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
      'datum_i_vrijeme_odrzavanja' => 'datetime'
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['naziv', 'movie_id', 'hall_id', 'datum_i_vrijeme_odrzavanja', 'trajanje'];                  //tu stavimo atribute koji ce se kroz request puniti u bazu, omogućavamo mass assignament


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hall()
    {
        return $this->belongsTo('App\Models\Hall', 'hall_id', 'id');
    }

    public function movie()
    {
        return $this->belongsTo('App\Models\Movie', 'movie_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation', 'id', 'show_id');
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
        $r['message'] = 'Molim obrišite sve vezane rezervacije prije brisanja predstave.';
        return $r;
      }

      return $r;
    }

    public function getDisplayPocetakAtAttribute()
    {
      return $this->datum_i_vrijeme_odrzavanja->format(config('kina.datetime_datetime'));
    }

    public function getDisplayDateAttribute()
    {
      return $this->datum_i_vrijeme_odrzavanja->format(config('kina.datetime_date'));
    }

    public function getDisplayTimeAttribute()
    {
      return $this->datum_i_vrijeme_odrzavanja->format(config('kina.datetime_time')). ' - '. $this->datum_i_vrijeme_odrzavanja->addMinutes($this->trajanje+30)->format(config('kina.datetime_time'));
    }

    public function getDisplayDateAndTimeAttribute()
    {
      return $this->datum_i_vrijeme_odrzavanja->format(config('kina.datetime_datetime')). ' - '. $this->datum_i_vrijeme_odrzavanja->addMinutes($this->trajanje+30)->format(config('kina.datetime_time'));
    }
}
