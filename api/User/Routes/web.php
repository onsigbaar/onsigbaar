<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Api\User\Http\Controllers'], function() {
    Route::get('/data-seeder', 'UserController@dataSeeder');
});