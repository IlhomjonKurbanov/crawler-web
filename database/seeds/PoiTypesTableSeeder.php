<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Poi_type;

class PoiTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('poi_types')->delete();

        Poi_type::create(['id' => 1, 'name' => 'Shop', 'description' => 'A shop in a venue']);
    }

}
