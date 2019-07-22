<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/19/19 12:30 AM
 */

use Illuminate\Http\Request;

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

    $userResponse = [
        'data'  => [
            'type'       => 'users',
            'id'         => $user->uuid,
            'attributes' => [
                'username' => $user->username,
                'name'     => $user->name,
                'email'    => $user->email,
            ],
        ],
        'links' => [
            'self' => $request->fullUrl(),
        ],
        'meta'  => [
            'copyright' => 'copyrightⒸ ' . date('Y') . ' ' . config('app.name'),
            'author'    => config('user.api.authors'),
        ],
    ];

    return response()->Api($userResponse);
});
