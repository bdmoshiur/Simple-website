<?php

use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Mission::create([
            'image' => 'logo.jpg',
        ]);
    }
}
