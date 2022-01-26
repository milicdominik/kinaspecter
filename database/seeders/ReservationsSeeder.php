<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tablename = 'reservations';
      $source = [
        ['user_id' => 6, 'show_id' => 9, 'seat_id' => 167],
        ['user_id' => 6, 'show_id' => 9, 'seat_id' => 185],
        ['user_id' => 6, 'show_id' => 14, 'seat_id' => 229],
        ['user_id' => 7, 'show_id' => 10, 'seat_id' => 175],
        ['user_id' => 15, 'show_id' => 9, 'seat_id' => 168],
        ['user_id' => 15, 'show_id' => 10, 'seat_id' => 167],
        ['user_id' => 12, 'show_id' => 15, 'seat_id' => 237],
      ];

      //dodaj kratki_naziv  = naziv svima
      /*foreach($source as $k => $v)
      {
        $source[$k]['kratki_naziv'] = $v['naziv'];
      }*/

      $data = [];
      foreach ($source as $s) {
        $check = DB::table($tablename)->where('show_id', $s['show_id'])->where('seat_id', $s['seat_id'])->first();
        if ($check) continue;
        $data[] = $s;
      }
      DB::table($tablename)->insert($data);
    }
}
