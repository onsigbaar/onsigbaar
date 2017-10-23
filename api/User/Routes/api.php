<?php

Route::group(['middleware' => 'api', 'prefix' => 'user', 'namespace' => 'Api\User\Http\Controllers'], function () {
    //
});

Route::group(['middleware' => 'api', 'prefix' => '', 'namespace' => 'App\Components\Passerby\Http\Controllers\Auth'], function () {
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/login/refresh', 'AuthController@refresh');
});

Route::group(['middleware' => 'auth:api', 'prefix' => '', 'namespace' => 'App\Components\Passerby\Http\Controllers\Auth'], function () {
    Route::post('/logout', 'AuthController@logout');
});