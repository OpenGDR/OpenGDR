<?php
use Illuminate\Support\Facades\Route;

Route::prefix('razze')->group(function () {
    Route::get('/', 'RaceController@getAdminList')->name('admin.race.list');
    Route::get('/edit/{id?}', 'RaceController@getAdminEdit')->name('admin.race.edit');
    Route::post('/edit/{id?}', 'RaceController@postAdminEdit');
});
