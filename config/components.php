<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Component Namespace
    |--------------------------------------------------------------------------
    |
    | Default component namespace.
    |
    */

    'namespace' => 'App\Components',

    /*
    |--------------------------------------------------------------------------
    | Component Stubs
    |--------------------------------------------------------------------------
    |
    | Default component stubs.
    |
    */

    'stubs' => [
        'enabled'      => false,
        'path'         => base_path(__DIR__ . '/../src/Commands/stubs'),
        'files'        => [
            'start'           => 'start.php',
            'routes'          => 'Http/routes.php',
            'json'            => 'component.json',
            'views/index'     => 'Resources/views/index.blade.php',
            'views/master'    => 'Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'Config/config.php',
            'composer'        => 'composer.json'
        ],
        'replacements' => [
            'start'           => ['LOWER_NAME'],
            'routes'          => ['LOWER_NAME', 'STUDLY_NAME', 'COMPONENT_NAMESPACE'],
            'json'            => ['LOWER_NAME', 'STUDLY_NAME', 'COMPONENT_NAMESPACE'],
            'views/index'     => ['LOWER_NAME'],
            'views/master'    => ['STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer'        => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'COMPONENT_NAMESPACE'
            ]
        ]
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Components path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated component. This path also will added
        | automatically to list of scanned folders.
        |
        */

        'components' => base_path('app/Components'),
        /*
        |--------------------------------------------------------------------------
        | Components assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the components assets path.
        |
        */

        'assets' => base_path('components'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'component:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | The seeds path
        |--------------------------------------------------------------------------
        |
        | Where you run 'component:publish-seed' command, where do you publish the
        | the seed files?
        |
        */

        'seed' => base_path('database/seeds'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        |
        | Here you may update the components generator path.
        |
        */

        'generator' => [
            'assets'        => 'Resources/assets',
            'config'        => 'Config',
            'command'       => 'Console',
            'event'         => 'Events',
            'listener'      => 'Events/Handlers',
            'migration'     => 'Database/Migrations',
            'model'         => 'Models',
            'repository'    => 'Repositories',
            'seed'          => 'Database/Seeds',
            'controller'    => 'Http/Controllers',
            'middleware'    => 'Http/Middleware',
            'request'       => 'Http/Requests',
            'provider'      => 'Providers',
            'lang'          => 'Resources/lang',
            'views'         => 'Resources/views',
            'test'          => 'Tests',
            'jobs'          => 'Jobs',
            'emails'        => 'Emails',
            'notifications' => 'Notifications'
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => true,
        'paths'   => [
            base_path('vendor/*/*')
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'componentsv',
        'author' => [
            'name'  => 'anonymoussc',
            'email' => '50c5ac69@opayq.com'
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache'    => [
        'enabled'  => false,
        'key'      => 'componentsv',
        'lifetime' => 60
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what components will register as custom namespaces.
    | Setting one to false will require to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true
    ],
    /*
    |--------------------------------------------------------------------------
    | Published assets merge.
    | Published assets will merge into target assets directory or
    | retain it's own components (as a directory) name
    |--------------------------------------------------------------------------
    */
    'merge'    => [
        'published-assets' => true
    ],
];
