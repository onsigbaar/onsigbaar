<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/14/19 11:43 PM
 */

namespace Api\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package Api\User\Entities
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $identifier
     *
     * @return mixed
     */
    public function findForPassport($identifier)
    {
        return $this->orWhere('username', $identifier)->orWhere('email', $identifier)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|null
     */
    public function role()
    {
        if (class_exists(\App\Components\Scaffold\Providers\ScaffoldServiceProvider::class)) {
            return $this->belongsTo('App\Components\Scaffold\Entities\Role');
        }

        return null;
    }

    /**
     * @return array|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        if (class_exists(\App\Components\Scaffold\Providers\ScaffoldServiceProvider::class)) {
            return $this->belongsToMany('App\Components\Scaffold\Entities\Role', 'user_roles', 'user_id', 'role_id');
        }

        return [];
    }
}
