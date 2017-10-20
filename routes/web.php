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

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/insert-user', function () {
    DB::table('users')->insert([
        'name' => 'rn',
        'email' => 'rn@rn.com',
        'password' => password_hash('1234', PASSWORD_BCRYPT)
    ]);

    return 'success';
})->name('register');