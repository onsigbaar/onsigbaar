<?php

Route::group(['middleware' => 'web', 'prefix' => 'app', 'namespace' => 'Api\App\Http\Controllers'], function() {
    Route::get('/', 'AppController@index');
    Route::get('/login', 'AppController@login')->name('login');
});