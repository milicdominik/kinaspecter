<?php
/**
* This trait gives ->active() method to query builder on model.
*/
namespace App\Traits;

trait DeletecheckTrait
{
    public function deletecheck(): array
    {
      $r = [
        'can' => true,
        'message' => null
      ];

      //test
      $r = [
        'can' => false,
        'message' => 'Provjera brisanja nije implementirana.'
      ];

      return $r;
    }
}
