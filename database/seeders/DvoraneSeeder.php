<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DvoraneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tablename = 'halls';
      $source = [
        ['naziv' => 'Mala dvorana'],
        ['naziv' => 'Srednja dvorana'],
        ['naziv' => 'Velika dvorana'],
        ['naziv' => 'VIP dvorana'],

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
