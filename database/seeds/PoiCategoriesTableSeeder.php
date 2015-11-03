<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Poi_category;

class PoiCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('poi_categories')->delete();

        Poi_category::create(['id' => 1, 'name' => 'Clothe shop']);
    }

}
