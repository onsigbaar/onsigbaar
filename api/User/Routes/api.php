<?php
Route::group(['prefix' => 'api'], function() {
    Route::group(['prefix' => '1'], function() {
        Route::group(['middleware' => 'api', 'prefix' => 'user', 'namespace' => 'Api\User\Http\Controllers'], function() {
            Route::get('/', 'UserController@get');
            Route::post('/', 'UserController@create');
            Route::put('/{id}', 'UserController@update');
            Route::delete('/{id}', 'UserController@delete');

            Route::get('/', 'UserController@tests');
        });
    });
});
