<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $ime = 'Dominik';
      $prezime = 'Milić';
      $mobitel = '385977897345';
      $email = 'dmilic@veleri.hr';
      $pass = '111111';

      $check = DB::table('users')->where('email',$email)->first();
      if($check)
        return;

      DB::table('users')->insert([
        'name' => Str::slug($ime.' '.$prezime,'.'),
        //'email' => $this->faker->unique()->safeEmail(),
        'email' => $email,
        'ime' => $ime,
        'prezime' => $prezime,
        'oib' => mt_rand(10000000000, 99999999999),
        'mobitel' => $mobitel,
        'dat_god_rodenja' => '1990-09-10',
        'is_posjetitelj' => false,
        'is_administracija' => true,
        'email_verified_at' => now(),
        'password' => Hash::make($pass),
        'created_at' => now(),
        'updated_at' => now()
      ]);

      $ime = 'Nika';
      $prezime = 'Širola';
      $mobitel = '385978752364';
      $email = 'nsirola@veleri.hr';
      $pass = '222222';

      $check = DB::table('users')->where('email',$email)->first();
      if($check)
        return;

      DB::table('users')->insert([
        'name' => Str::slug($ime.' '.$prezime,'.'),
        //'email' => $this->faker->unique()->safeEmail(),
        'email' => $email,
        'ime' => $ime,
        'prezime' => $prezime,
        'oib' => mt_rand(10000000000, 99999999999),
        'mobitel' => $mobitel,
        'dat_god_rodenja' => '1995-09-10',
        'is_posjetitelj' => false,
        'is_administracija' => true,
        'email_verified_at' => now(),
        'password' => Hash::make($pass),
        'created_at' => now(),
        'updated_at' => now()
      ]);

      $ime = 'Ivo';
      $prezime = 'Ivić';
      $mobitel = '385977125648';
      $email = 'iivic@veleri.hr';
      $pass = '333333';

      $check = DB::table('users')->where('email',$email)->first();
      if($check)
        return;

      DB::table('users')->insert([
        'name' => Str::slug($ime.' '.$prezime,'.'),
        //'email' => $this->faker->unique()->safeEmail(),
        'email' => $email,
        'ime' => $ime,
        'prezime' => $prezime,
        'oib' => mt_rand(10000000000, 99999999999),
        'mobitel' => $mobitel,
        'dat_god_rodenja' => '1998-10-10',
        'is_posjetitelj' => false,
        'is_administracija' => false,
        'email_verified_at' => now(),
        'password' => Hash::make($pass),
        'created_at' => now(),
        'updated_at' => now()
      ]);

    }

}
