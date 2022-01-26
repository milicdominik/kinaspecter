<?php

return [
  //koliko metara od pozicije cemo smatrati lokaciju validnom
  //npr ako stavimo 10 onda ce biti MIN: <poredavaonica.lat>-10 a max: <poredavaonica.lat>+10
  //isto za lon, stvaramo kocku za sad u kodu, ako treba radius moze se preraditi
  'allowed_polumjer_meters' => 10,

  //koliko maksimalno puta ce program zatraziti novu geolokaciju pri prijavljivanju
  //na satnicu prije nego se pokaze poruka greske
  'max_gps_tries' => 5, //dogovoreno 5 pokusaja

  'default_geolocation' => [
    //Important: string with decimal dot (.) as seperator
    'lat' => '45.33581575094725',
    'lng' => '14.42938327789307',
  ],
];
