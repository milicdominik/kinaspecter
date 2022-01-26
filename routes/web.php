<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//PUBLICSITE
Route::get('/', function () {return redirect()->route('naslovna');})->name('root');

Route::get('naslovna', 'App\Http\Controllers\PublicsiteController@index')->name('naslovna');
Route::get('onama', 'App\Http\Controllers\PublicsiteController@onama')->name('onama');
Route::get('galerija', 'App\Http\Controllers\PublicsiteController@galerija')->name('galerija');
Route::get('dvorane', 'App\Http\Controllers\PublicsiteController@dvorane')->name('dvorane');
Route::get('mala', 'App\Http\Controllers\PublicsiteController@mala')->name('mala');
Route::get('srednja', 'App\Http\Controllers\PublicsiteController@srednja')->name('srednja');
Route::get('velika', 'App\Http\Controllers\PublicsiteController@velika')->name('velika');
Route::get('vip', 'App\Http\Controllers\PublicsiteController@vip')->name('vip');
Route::get('cjenik', 'App\Http\Controllers\PublicsiteController@cjenik')->name('cjenik');
Route::get('kontakt', 'App\Http\Controllers\PublicsiteController@kontakt')->name('kontakt');
Route::get('politika-privatnosti', 'App\Http\Controllers\PublicsiteController@politika_privatnosti')->name('politika_privatnosti');

Auth::routes();
//Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {

  Route::get('dash', 'App\Http\Controllers\DashboardController@dashboard')->name('home');
  //Route::get('dash/zaposlenik', 'App\Http\Controllers\DashboardController@dashboard_zaposlenik')->name('dash.zaposlenik');
  //Route::get('dash/posjetitelj', 'App\Http\Controllers\DashboardController@dashboard_posjetitelj')->name('dash.posjetitelj');
  //Route::get('dash/administracija', 'App\Http\Controllers\DashboardController@dashboard_administracija')->name('dash.administracija');
  Route::resource('genres', 'App\Http\Controllers\GenreController')->parameters(['genres' => 'genre']);
  Route::resource('halls', 'App\Http\Controllers\HallController')->parameters(['halls' => 'hall']);
  Route::resource('seats', 'App\Http\Controllers\SeatController')->parameters(['seats' => 'seat']);
  Route::resource('movies', 'App\Http\Controllers\MovieController')->parameters(['movies' => 'movie']);
  Route::resource('shows', 'App\Http\Controllers\ShowController')->parameters(['shows' => 'show']);
  Route::resource('reservations', 'App\Http\Controllers\ReservationController')->parameters(['reservations' => 'reservation']);
  Route::resource('users', 'App\Http\Controllers\UserController')->parameters(['users' => 'user']);
  Route::get('profile/{user}', 'App\Http\Controllers\UserController@profile_redirect')->name('profile.show');
  Route::post('upload/ckeditor','App\Http\Controllers\DashboardController@ckeditor')->name('upload.ckeditor');
});
