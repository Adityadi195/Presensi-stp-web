<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/riwayat', 'HomeController@riwayathome')->name('riwayathome');


Route::get('cari','UserController@index');
    Route::resource('user', 'UserController');
    Route::resource('presensi', 'PresensiController')->only(['index', 'show']);
    Route::get('/cari','PresensiController@index');