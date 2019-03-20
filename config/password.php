<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 3/21/19 5:53 AM
 */

return [
    'name'         => 'Passerby',
    'refreshToken' => [
        'cookie' => [
            'httpOnly' => true,
            'expire'   => 864000 // 864000 value will make the cookies expire in 10 days
        ],
    ],
    'log'          => [ // log info into database, default into signal_log table
        'info' => [
            'login'   => [
                'active'  => false,
                'message' => 'User has successfully login.',
            ],
            'refresh' => [
                'active'  => false,
                'message' => 'Token refreshed.',
            ],
            'logout'  => [
                'active'  => false,
                'message' => 'User has successfully logout.',
            ],
        ],
    ],
    'client'       => [
        'id'     => env('PASSWORD_CLIENT_ID'),
        'secret' => env('PASSWORD_CLIENT_SECRET'),
    ],
];
