<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/19/19 12:34 AM
 */

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(function($router) {
            $router->forAccessTokens();
            $router->forPersonalAccessTokens();
            $router->forTransientTokens();
        });

        if (class_exists(\App\Components\Scaffold\Providers\ScaffoldServiceProvider::class)) {
            if (Schema::hasTable('permissions')) {
                if (class_exists(\App\Components\Scaffold\Entities\Permission::class)) {
                    $permissions = \App\Components\Scaffold\Entities\Permission::where('id', '>', 0)->pluck('key');
                    $scopes      = [];

                    foreach ($permissions as $permit) {
                        $scopes[$permit] = ucwords(str_replace('_', ' ', $permit));
                    }

                    Passport::tokensCan($scopes);
                }
            }
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes(10));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
    }
}
