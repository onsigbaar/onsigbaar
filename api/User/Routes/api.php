<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/16/19 12:56 PM
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function(Request $request) {
    $user = $request->user();

    return [
        'data' => [
            'type'       => 'users',
            'id'         => $user->uuid,
            'attributes' => [
                'username' => $user->username,
                'name'     => $user->name,
                'email'    => $user->email,
            ],
        ],
        'link' => $request->fullUrl(),
        'meta' => [
            'copyright' => 'copyrightⒸ ' . date('Y') . ' ' . \Illuminate\Support\Facades\Config::get('app.name'),
            'author'    => Config::get('user.api.authors'),
        ],
    ];
});
