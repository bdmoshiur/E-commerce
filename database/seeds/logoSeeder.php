<?php

use Illuminate\Database\Seeder;

class logoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Logo::create([
            'image' => 'logo.jpg'
        ]);
    }
}
