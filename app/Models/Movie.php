<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;

class Movie extends Model
{
    use HasFactory;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'movies';

    public $timestamps = true;

    static $rules = [
  		'naslov' => 'required',
      'redatelj' => 'required',
      'genre_id' => 'required|int|exists:genres,id',
  		'trajanje' => 'required|int',
  		'godina_izlaska' => 'required|int',
  		'uloge' => 'required',
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
    protected $fillable = ['naslov', 'redatelj', 'genre_id', 'trajanje', 'godina_izlaska', 'uloge', 'opis'];                  //tu stavimo atribute koji ce se kroz request puniti u bazu, omogućavamo mass assignament


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function genre()
    {
        return $this->hasOne('App\Models\Genre', 'id', 'genre_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shows()
    {
        return $this->hasMany('App\Models\Show', 'id', 'movie_id');
    }

    public function deletecheck(): array
    {
      //$check_
      $r = [
        'can' => true,
        'message' => null
      ];

      $count_predstave = $this->shows()->count();
      if($count_predstave)
      {
        $r['can'] = false;
        $r['message'] = 'Molim obrišite sve vezane predstave prije brisanja filma.';
        return $r;
      }

      return $r;
    }
}
