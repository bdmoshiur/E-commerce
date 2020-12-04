<?php

use Illuminate\Database\Seeder;

class contractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Contact::create([
            'address' => 'faridpur dhaka bangladesh',
            'mobile_no' => '01749302454',
            'email' => 'moshiurcse888@gmail.com',
            'facebook' => 'https://www.facebook.com/moshiurcse888/',
            'twitter' => 'https://twitter.com/Moshiurcse888',
            'youtube' => 'https://www.youtube.com/channel/UCawTtLjZvUQ_6zBQyfUT7vw?view_as=subscriber',
            'google_plus' => 'https://myaccount.google.com/profile',
        ]);
    }
}
