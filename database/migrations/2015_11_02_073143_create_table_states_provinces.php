<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStatesProvinces extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('states_provinces', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('countries');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('states_provinces');
	}

}
