<?php

use Illuminate\Database\Seeder;

class VissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Vission::create([
            'image' => 'logo.jpg',
        ]);
    }
}
