<?php

Route::group(['middleware' => 'web', 'prefix' => 'onsigbaar', 'namespace' => 'App\\Components\Onsigbaar\Http\Controllers'], function()
{
    Route::get('/', 'OnsigbaarController@index');
});
