<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('user')->group(function() {
    // Route::get('/', 'UserController@index');
    /*
    Route::get('/add', function (){
        DB::table('users')->insert([
            'name' => 'rn',
            'email' => 'rn@test.com',
            'password' => password_hash('1234', PASSWORD_BCRYPT)
        ]);
    });*/
});
