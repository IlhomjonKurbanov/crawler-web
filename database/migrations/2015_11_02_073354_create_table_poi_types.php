<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePoiTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('poi_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable(); // store, escalator, elevator, restroom, atm, exit, stairs, information, food, lounges
			$table->text('description')->nullable();
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
		Schema::drop('poi_types');
	}

}
