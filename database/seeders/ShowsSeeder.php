<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tablename = 'shows';
      $source = [
        ['naziv' => 'Ulica noćnih mora 3D', 'movie_id' => 1, 'hall_id' => 2, 'datum_i_vrijeme_odrzavanja' => '2022-02-15 18:30:00', 'trajanje' => '180'],
        ['naziv' => 'Ulica noćnih mora 3D', 'movie_id' => 1, 'hall_id' => 2, 'datum_i_vrijeme_odrzavanja' => '2022-02-15 22:00:00', 'trajanje' => '180'],
        ['naziv' => 'Ulica noćnih mora', 'movie_id' => 1, 'hall_id' => 1, 'datum_i_vrijeme_odrzavanja' => '2022-02-15 19:30:00', 'trajanje' => '180'],
        ['naziv' => 'Ulica noćnih mora 4D', 'movie_id' => 1, 'hall_id' => 2, 'datum_i_vrijeme_odrzavanja' => '2022-02-16 18:30:00', 'trajanje' => '180'],
        ['naziv' => 'Matrix Uskrsnuće 4D', 'movie_id' => 4, 'hall_id' => 4, 'datum_i_vrijeme_odrzavanja' => '2022-02-15 18:30:00', 'trajanje' => '178'],
        ['naziv' => 'Matrix Uskrsnuće', 'movie_id' => 4, 'hall_id' => 3, 'datum_i_vrijeme_odrzavanja' => '2022-02-16 18:30:00', 'trajanje' => '178'],
        ['naziv' => 'Matrix Uskrsnuće', 'movie_id' => 4, 'hall_id' => 3, 'datum_i_vrijeme_odrzavanja' => '2022-02-16 22:30:00', 'trajanje' => '178'],
        ['naziv' => 'Matrix Uskrsnuće', 'movie_id' => 4, 'hall_id' => 1, 'datum_i_vrijeme_odrzavanja' => '2022-02-15 18:30:00', 'trajanje' => '178'],
      ];

      //dodaj kratki_naziv  = naziv svima
      /*foreach($source as $k => $v)
      {
        $source[$k]['kratki_naziv'] = $v['naziv'];
      }*/

      $data = [];
      foreach ($source as $s) {
        $vrijeme = Carbon::Parse($s['datum_i_vrijeme_odrzavanja'])->addMinutes($s['trajanje']);
        $check = DB::table($tablename)->where('hall_id', $s['hall_id'])->where('datum_i_vrijeme_odrzavanja', '>=', $s['datum_i_vrijeme_odrzavanja'])->where('datum_i_vrijeme_odrzavanja', '<=', $vrijeme)->first();
        if ($check) continue;
        $data[] = $s;
      }
      DB::table($tablename)->insert($data);
    }
}
