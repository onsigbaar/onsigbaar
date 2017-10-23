<?php

Route::group(['middleware' => 'web', 'prefix' => 'app', 'namespace' => 'Api\App\Http\Controllers'], function() {
    Route::get('/', 'AppController@index');
});