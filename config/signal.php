<?php

return [
    'name'        => 'Signal',

    // Enable logging activity
    'logActivity' => env('LOG_ACTIVITY', true),

    // Specific logging control when logActivity option enabled
    'emergency'   => false,
    'alert'       => false,
    'critical'    => false,
    'error'       => true,
    'warning'     => false,
    'notice'      => false,
    'info'        => false,
    'debug'       => false,

    // Sent log data to email
    'email' => [
        // Set to 'true' to sent log data to email
        'sent'   => env('SIGNAL_EMAIL_SENT', false),
        'sentTo' => env('SIGNAL_EMAIL_SENT_TO', 'example@example.io'),
    ],
];
