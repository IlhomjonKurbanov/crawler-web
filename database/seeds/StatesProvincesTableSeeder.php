<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\State_province;

class StatesProvincesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('states_provinces')->delete();

        State_province::create(['id' => 1, 'name' => 'Minnesota', 'country_id' => 1]);
    }

}
