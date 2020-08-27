<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('home.public');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/utente-bannato', 'UserController@getBannedPage')->name('banned');

Route::prefix('utente')->group(function () {
    Route::get('/impostazioni', 'UserController@settings')->name('user.settings');
    Route::post('/impostazioni', 'UserController@updatePassword')->name('user.settings.password');
    Route::post('/impostazioni/cancella-utente', 'UserController@deleteUser')->name('user.settings.delete-user');
    Route::post('/impostazioni/aggiorna-utente', 'UserController@updateUser')->name('user.settings.update');
});
