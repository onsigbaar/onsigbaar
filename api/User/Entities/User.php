<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 2/28/19 6:16 AM
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
}
