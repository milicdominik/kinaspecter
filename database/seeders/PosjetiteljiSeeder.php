<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PosjetiteljiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $posjetitelji = User::factory()->count(10)->create();
    }
}
