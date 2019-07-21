<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/19/19 12:31 AM
 */

use Illuminate\Database\Seeder;

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
                'uuid'              => randomUuid(),
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