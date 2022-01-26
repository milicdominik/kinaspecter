<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;

class Reservation extends Model
{
    use HasFactory;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'shows';

    public $timestamps = true;

    static $rules = [
  		'user_id' => 'required|int|exists:users,id',
      'show_id' => 'required|int|exists:shows,id',
      'seat_id' => 'required|int|exists:seats,id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'show_id', 'seat_id'];                  //tu stavimo atribute koji ce se kroz request puniti u bazu, omogućavamo mass assignament


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function show()
    {
        return $this->belongsTo('App\Models\Show', 'show_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function seat()
    {
        return $this->belongsTo('App\Models\Seat', 'seat_id', 'id');            //bira samo 1 sjedalo za rezervirati
    }

    public function deletecheck(): array
    {
      //$check_... ovaj nema vezanih tablica... uvijek se može obrisati.
      $r = [
        'can' => true,
        'message' => null
      ];

      return $r;
    }
}
