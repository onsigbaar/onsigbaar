<?php

Route::group(['middleware' => 'web', 'prefix' => 'app', 'namespace' => 'Api\App\Http\Controllers'], function() {
    //
});

Route::get('/', 'Api\App\Http\Controllers\AppController@index')->middleware('web');