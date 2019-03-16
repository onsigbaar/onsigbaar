<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 2/28/19 6:16 AM
 */

use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 =>
            array (
                'uuid'              => Uuid::generate(5, 'user', Uuid::NS_DNS),
                'username'          => 'user',
                'name'              => 'user',
                'email'             => 'user@api.com',
                'email_verified_at' => NULL,
                'password'          => password_hash('user', PASSWORD_BCRYPT),
                'remember_token'    => NULL,
                'created_at'        => NULL,
                'updated_at'        => NULL,
            ),
        ));
        
        
    }
}