<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'     => 'أحمد الإسناوي',
            'email'    => 'admin@admin.com',
            'password' => '123123',
            'type' => 'admin',
            'status'   => 'active' 
        ]);
    }
}
