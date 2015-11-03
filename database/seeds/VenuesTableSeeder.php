<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Venue;

class VenuesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('venues')->delete();

        Venue::create(['id' => 1, 'name' => 'Mall of America', 'description' => 'One of biggest malls in America', 'venue_type_id' => 1, 'gps_latitude' => '34.4255648', 'gps_longitude' => '-103.1964765', 'zip_postal_code' => '55019']);
    }

}
