<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\City;

class CitiesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cities')->delete();

        City::create(['id' => 1, 'name' => 'Bloomington', 'province_id' => 1]);
    }

}
