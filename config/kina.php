<?php

return [

    #Following values can be overriden in tenant settings table
    'version' => '1.0.37',
    'version_build_date' => '05.01.2022. 10:50',
    //'adminpasswordprefix' => 'tsi',
    /*
    |--------------------------------------------------------------------------
    | Datetime formats
    |--------------------------------------------------------------------------
    |
    */
    'datetime_date' => 'd.m.Y',
    'datetime_time' => 'H:i',
    'datetime_datetime' => 'd.m.Y. H:i',
    'datetime_datetimeseconds' => 'd.m.Y. H:i:s',

    'datetime_format_js' => 'DD.MM.YYYY', //for datepicker or inputmask
    //'datetime_format_js_tophp' => 'd.m.Y', //datetime_format_js php validate by comparing this format

    //'time_format_js' => 'hh:mm',
    //'time_format_js_tophp' => 'H:i',

    /*
    |--------------------------------------------------------------------------
    | Fakultet
    |--------------------------------------------------------------------------
    |
    */
    //koliko minuta prije pocetka predstave posjetitelj moze rezervirati kartu
    'checkin_before_minutes' => 60, //1 sata prije
    'checkin_after_minutes' => 0, //0 sata poslije
    //koliko minuta prije kraja i poslije kraja predstave posjetitelj moze dati feedback za tu predstavu (zvjezdice)
    'rate_before_end_minutes' => 0,
    'rate_after_end_minutes' => 20,

    //koliko max fotografija se moze ucitati kad se importaju avatari usera
    'upload_max_fotografije' => env('KINA_UPLOAD_MAX_FOTOGRAFIJE', 20),

    //koliko minuta traje administrativni pristup
    'adminaccess_minutes' => 120, //120
];
