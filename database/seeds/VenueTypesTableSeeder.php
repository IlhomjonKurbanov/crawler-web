<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Venue_type;

class VenueTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('venue_types')->delete();

        Venue_type::create(['id' => 1, 'name' => 'Mall', 'description' => 'A mall have many shop into']);
        Venue_type::create(['id' => 2, 'name' => 'Airport', 'description' => 'An airport is an aerodrome with facilities for flights to take off and land']);
        Venue_type::create(['id' => 3, 'name' => 'Convention', 'description' => 'A large gathering of people who share a common interest']);
    }

}
