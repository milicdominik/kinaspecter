<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tablename = 'genres';
      $source = [
        ['naziv' => 'Akcija'],
        ['naziv' => 'Drama'],
        ['naziv' => 'Horor'],
        ['naziv' => 'Triler'],
        ['naziv' => 'Dokumentarni'],
        ['naziv' => 'Znanstvena fantastika'],
        ['naziv' => 'Komedija'],

      ];

      //dodaj kratki_naziv  = naziv svima
      /*foreach($source as $k => $v)
      {
        $source[$k]['kratki_naziv'] = $v['naziv'];
      }*/

      $data = [];
      foreach ($source as $s) {
        $check = DB::table($tablename)->where('naziv', $s['naziv'])->first();
        if ($check) continue;
        $data[] = $s;
      }
      DB::table($tablename)->insert($data);
    }
}
