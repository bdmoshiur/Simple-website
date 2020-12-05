<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        App\User::create([
            'usertype' => 'admin',
            'name' => 'moshiur rahman',
            'email' => 'moshiurcse888@gmail.com',
            'mobile' => '01749302454',
            'address' => 'dhaka bangladesh',
            'gender' => 'male',
            'image' => 'logo.jpg',
            'password' => bcrypt('12345678')
        ]);
    }
}
