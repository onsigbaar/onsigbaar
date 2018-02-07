<?php

Route::group(['middleware' => 'web', 'prefix' => 'appbase', 'namespace' => 'Api\AppBase\Http\Controllers'], function() {
    Route::get('/', 'AppBaseController@index');
});