<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/17/19 5:43 AM
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
        'data' => [
            'type'       => 'users',
            'id'         => $user->uuid,
            'attributes' => [
                'username' => $user->username,
                'name'     => $user->name,
                'email'    => $user->email,
            ],
        ],
        'links' => $request->fullUrl(),
        'meta' => [
            'copyright' => 'copyrightⒸ ' . date('Y') . ' ' . config('app.name'),
            'author'    => config('user.api.authors'),
        ],
    ];

    return response()->Api($userResponse);
});
