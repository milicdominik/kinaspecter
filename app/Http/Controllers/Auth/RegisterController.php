<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ime' => ['required', 'string', 'max:255'],
            'prezime' => ['required', 'string', 'max:255'],
            'oib' => ['required', 'string', 'max:13', 'unique:users'],
            'mobitel' => ['required', 'string', 'max:12', 'unique:users'],
            'dat_god_rodenja' => ['required', 'string', 'date'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $ime = $data['ime'];
        $prezime = $data['prezime'];

        return User::create([
            'name' => Str::slug($prezime.' '.$ime,'.'),
            'email' => $data['email'],
            'ime' => $ime,
            'prezime' => $prezime,
            'oib' => $data['oib'],
            'mobitel' => $data['mobitel'],
            'dat_god_rodenja' => $data['dat_god_rodenja'],
            'is_posjetitelj' => true,
            'is_administracija' => false,
            'password' => Hash::make($data['password']),
        ]);
    }
}
