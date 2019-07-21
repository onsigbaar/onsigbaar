<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/22/19 3:51 AM
 */

return [
    'name'         => 'Passerby',
    'refreshToken' => [
        'cookie' => [
            'httpOnly' => env('COOKIE_HTTP_ONLY', false),
            'expire'   => 864000 // 864000 value will make the cookies expire in 10 days
        ],
    ],

    'log' => [// log info into database, default into signal_log table
              'info' => [
                  'login'  => [
                      'active'  => true,
                      'message' => 'User has successfully login.',
                  ],
                  'logout' => [
                      'active'  => true,
                      'message' => 'User has successfully logout.',
                  ],
              ],
    ],

    'client' => [
        'id'     => env('PASSWORD_CLIENT_ID'),
        'secret' => env('PASSWORD_CLIENT_SECRET'),
    ],
];
