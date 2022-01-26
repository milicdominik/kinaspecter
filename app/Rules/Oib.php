<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Oib implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $oib)
    {

      // OIB ima 11 znamenaka i mora biti numeric.
      if ( mb_strlen( $oib ) != 11 || ( ! is_numeric( $oib ) ) ) {
         return false;
      }

      // Posljednja tj. 11. znamenka je kontrolna znamenka. Dobivena  je
      // izračunom  iz  prethodnih  10  znamenaka  po međunarodnoj  normi  ISO 7064 (MOD 11, 10).

      // Prva znamenka zbroji se s brojem 10. U sljedećim koracima to će biti ostatak koji će se zbrajati
      // s idućom znamenkom.
      $ostatak = 10;

      // Prođi kroz sve znamenke, osim zadnje.
      for ( $i = 0; $i < 10; $i++ ) {
         // Dohvati trenutni znak iz OIBa i castaj ga u int kako bismo mogli raditi operacije.
         $trenutnaZnamenka = (int) $oib[$i];

         // 1. Prva znamenka zbroji se s brojem 10, a svaka sljedeća s ostatkom u prethodnom koraku.
         $zbroj = $trenutnaZnamenka + $ostatak;

         // 2. Dobiveni  zbroj  cjelobrojno  (s  ostatkom)  podijeli  se  brojem  10;  ako  je  dobiveni
         // ostatak 0 zamijeni se brojem 10 (ovaj broj je tzv. međuostatak)
         $meduOstatak = $zbroj % 10;
         if ( $meduOstatak == 0) {
            $meduOstatak = 10;
         }

         // 3. Dobiveni međuostatak pomnoži se brojem 2
         $umnozak = $meduOstatak * 2;

         // 4. Dobiveni  umnožak  cjelobrojno  (s  ostatkom)  podijeli se  brojem  11;  ovaj  ostatak
         // matematički nikako ne može biti 0 jer je rezultat prethodnog koraka uvijek paran broj
         $ostatak = $umnozak % 11;

         // 5. Slijedeća znamenka zbroji se s ostatkom u prethodnom koraku...
         // 6. Ponavljaju se koraci 2, 3, 4 i 5  dok se ne potroše sve znamenke...
      }

      // 7. Razlika izmeñu broja 11 i ostatka u zadnjem koraku je kontrolna znamenka.
      // Ako je ostatak 1 kontrolna znamenka je 0 (11 1=10, a 10 ima dvije znamenke)
      if ( $ostatak == 1 ) {
         $kontrolnaZnamenka = 0;
      }
      else {
         $kontrolnaZnamenka = 11 - $ostatak;
      }

      // Provjeri dali kontrolne znamenka odgovara onoj u OIBu
      if ( ( (int) $oib[10] ) == $kontrolnaZnamenka ) {
         return true;
      }

      // Ako smo došli tu, kontrola nije prošla.
      return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.regex');
    }
}
