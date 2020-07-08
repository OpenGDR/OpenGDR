<?php
use Illuminate\Support\Facades\Route;

Route::prefix('utenti')->group(function () {
    Route::get('/', 'UserController@getAdminList')->name('admin.user.list');
    Route::get('/modifica/{id?}', 'UserController@getAdminEdit')->name('admin.user.edit');
    Route::post('/modifica/{id?}', 'UserController@postAdminEdit');
});


Route::prefix('razze')->group(function () {
    Route::get('/', 'RaceController@getAdminList')->name('admin.race.list');
    Route::get('/modifica/{id?}', 'RaceController@getAdminEdit')->name('admin.race.edit');
    Route::post('/modifica/{id?}', 'RaceController@postAdminEdit');
});
