<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CountriesTableSeeder');
		$this->call('StatesProvincesTableSeeder');
		$this->call('CitiesTableSeeder');
		$this->call('VenueTypesTableSeeder');
		$this->call('PoiCategoriesTableSeeder');
		$this->call('PoiTypesTableSeeder');
	}

}
