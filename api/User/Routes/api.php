<?php

Route::group(['middleware' => 'api', 'prefix' => 'user', 'namespace' => 'Api\User\Http\Controllers'], function () {
    //
});

Route::group(['middleware' => 'api', 'prefix' => '', 'namespace' => 'App\Components\Passerby\Http\Controllers\Auth'], function () {
    Route::post('/login', 'LoginController@login');
    Route::post('/login/refresh', 'LoginController@refresh');
});

Route::group(['middleware' => 'auth:api', 'prefix' => '', 'namespace' => 'App\Components\Passerby\Http\Controllers\Auth'], function () {
    Route::post('/logout', 'LoginController@logout');
});