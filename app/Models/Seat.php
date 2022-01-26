<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;


class Seat extends Model
{
    use HasFactory;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'seats';

    public $timestamps = true;

    static $rules = [
  		'naziv' => 'required|max:6',
      'hall_id'=> 'nullable|int',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    protected $fillable = ['naziv', 'hall_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hall()
    {
        return $this->belongsTo('App\Models\Hall', 'hall_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation', 'id', 'seat_id');
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
        $r['message'] = 'Molim obrišite sve vezane rezervacije prije brisanja sjedala.';
        return $r;
      }

      return $r;
    }
}
