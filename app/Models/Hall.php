<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Traits\DeletecheckTrait;

class Hall extends Model
{
    use HasFactory;
    use Sortable;
    use DeletecheckTrait;

    protected $table = 'halls';

    public $timestamps = true;

    static $rules = [
  		'naziv' => 'required',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    protected $fillable = ['naziv'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats()
    {
        return $this->hasMany('App\Models\Seat', 'hall_id', 'id');
    }

    public function shows()
    {
        return $this->hasMany('App\Models\Show', 'hall_id', 'id');
    }

    public function deletecheck(): array
    {
      //$check_
      $r = [
        'can' => true,
        'message' => null
      ];

      $count_sjedala = $this->seats()->count();
      if($count_sjedala)
      {
        $r['can'] = false;
        $r['message'] = 'Molim obrišite sva vezana sjedala prije brisanja dvorane.';
        return $r;
      }

      $count_predstave = $this->shows()->count();
      if($count_predstave)
      {
        $r['can'] = false;
        $r['message'] = 'Molim obrišite sve vezane predstave prije brisanja dvorane.';
        return $r;
      }

      return $r;
    }
}
