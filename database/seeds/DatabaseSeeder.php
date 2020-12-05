<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(MissionSeeder::class);
        $this->call(VissionSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(LogoSeeder::class);
    }
}
