<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Country;

class CountriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('countries')->delete();

        Country::create(['id' => 1, 'name' => 'United State']);
    }

}
