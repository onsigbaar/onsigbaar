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

        Route::group(['middleware' => 'api', 'prefix' => 'role', 'namespace' => 'Api\User\Http\Controllers'], function() {
            Route::get('/', 'RoleController@get');
            Route::post('/', 'RoleController@create');
            Route::put('/{id}', 'RoleController@update');
            Route::delete('/{id}', 'RoleController@delete');
        });

        Route::group(['middleware' => 'api', 'prefix' => 'permission', 'namespace' => 'Api\User\Http\Controllers'], function() {
            Route::get('/', 'PermissionController@get');
            Route::post('/', 'PermissionController@create');
            Route::put('/{id}', 'PermissionController@update');
            //Route::delete('/deletes', 'PermissionController@deleteWhereArray');
            Route::delete('/{id}', 'PermissionController@delete');
        });

        Route::group(['middleware' => 'auth:api', 'prefix' => '', 'namespace' => 'Api\User\Http\Controllers'], function() {
            Route::get('/intest', 'UserController@inTests');
            Route::get('/outest', 'UserController@authTests');
        });
    });

    Route::group(['middleware' => 'api', 'prefix' => 'login', 'namespace' => 'Api\User\Http\Controllers\Auth'], function() {
        Route::post('/', 'LoginController@login');
        Route::post('/refresh', 'LoginController@refresh');
    });
    Route::group(['middleware' => 'auth:api', 'prefix' => '', 'namespace' => 'Api\User\Http\Controllers\Auth'], function() {
        Route::post('/logout', 'LoginController@logout');
    });
});
