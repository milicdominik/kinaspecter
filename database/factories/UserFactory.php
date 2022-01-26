<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $ime = $this->faker->firstName();
      $prezime = $this->faker->lastName();
      $mobitel = '38597'.mt_rand(1000000, 9999999);                                           //ili $this->faker->phoneNumber();
      $email = Str::slug($ime.' '.$prezime,'.').rand(1,999999999).'_demo@specter.hr';
        return [
            'name' => Str::slug($ime.' '.$prezime,'.'),
            //'email' => $this->faker->unique()->safeEmail(),
            'email' => $email,
            'ime' => $ime,
            'prezime' => $prezime,
            'oib' => mt_rand(10000000000, 99999999999),
            'mobitel' => $mobitel,          //ili '09'.$faker->unique()->randomKey([000000000, 999999999]),       ili $faker->regexify('09[0-9]{9}')
            'dat_god_rodenja' => $this->faker->date($format = 'D-m-y', $max = '2012',$min = '1990'),       //ili $this->faker->dateTimeBetween('1990-01-01', '2004-12-31')->format('d/m/Y'),
            'is_posjetitelj' => true,
            'is_administracija' => false,
            'email_verified_at' => now(),
            //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => '$2y$10$wOZVOHxYqLvKptHcwrqPd.oKCQo7o6jjwYJsnPAUa2lxM3rt5H5y6', // password is "n"
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
