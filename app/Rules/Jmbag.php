<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Jmbag implements Rule
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
     * https://www.pravo.unizg.hr/studij/integrirani-pravni/referada/jmbag
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $jmbag)
    {
      // JMBAG ima 10 znamenaka i mora biti numeric.
      if ( mb_strlen( $jmbag ) != 10 || ( ! is_numeric( $jmbag ) ) ) {
         return false;
      }
      return true;
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
