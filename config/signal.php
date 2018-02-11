<?php

return [
    'name'        => 'Signal',

    'log'   => [
        // Enable logging activity
        'activity'  => env('LOG_ACTIVITY', true),
        // Specific logging control when log.activity option enabled
        'emergency' => false,
        'alert'     => false,
        'critical'  => false,
        'error'     => true,
        'warning'   => false,
        'notice'    => false,
        'info'      => false,
        'debug'     => false,
    ],

    // Sent log data to email
    'email' => [
        // Set to 'true' to sent log data to email
        'sent'   => env('SIGNAL_EMAIL_SENT', false),
        'sentTo' => env('SIGNAL_EMAIL_SENT_TO', 'noreply@example.com'),
    ],
];
