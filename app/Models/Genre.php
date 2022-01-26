<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;

class Genre extends Model
{
    use HasFactory;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'genres';

    public $timestamps = true;

    static $rules = [
  		'naziv' => 'required'
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
    protected $fillable = ['naziv'];                  //tu stavimo atribute koji ce se kroz request puniti u bazu, omogućavamo mass assignament


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movies()
    {
        return $this->hasMany('App\Models\Movie', 'id', 'genre_id');
    }

    public function deletecheck(): array
    {
      //$check_
      $r = [
        'can' => true,
        'message' => null
      ];

      $count_filmovi = $this->movies()->count();
      if($count_filmovi)
      {
        $r['can'] = false;
        $r['message'] = 'Molim obrišite sve vezane filmove prije brisanja žanra.';
        return $r;
      }

      return $r;
    }
}
