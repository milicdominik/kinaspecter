<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SjedistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tablename = 'seats';
      $slova = [
        ['ime' => 'A'],
        ['ime' => 'B'],
        ['ime' => 'C'],
        ['ime' => 'D'],
      ];
      $source = [];

      for($j = 1; $j <= 4; $j++) {
        foreach ($slova as $slovo) {
          for($i = 1; $i <= 10; $i++) {
            $source = [
              ['naziv' => $slovo['ime'].$i, 'hall_id' => $j],
            ];
            $data = [];
            foreach ($source as $s) {
              $check = DB::table($tablename)->where('naziv', $s['naziv'])->where('hall_id', $s['hall_id'])->first();
              if ($check) continue;
              $data[] = $s;
            }
            DB::table($tablename)->insert($data);
          }
        }
      }

      //dodaj kratki_naziv  = naziv svima
      /*foreach($source as $k => $v)
      {
        $source[$k]['kratki_naziv'] = $v['naziv'];
      }*/


    }
}
