<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePointsOfInterest extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('points_of_interest', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('poi_type_id')->unsigned();
			$table->foreign('poi_type_id')->references('id')->on('poi_types');
			$table->integer('poi_category_id')->unsigned();
			$table->foreign('poi_category_id')->references('id')->on('poi_categories');
			$table->string('cover_photo');
			$table->integer('node_id')->unsigned();
			$table->foreign('node_id')->references('id')->on('nodes');
			$table->integer('venue_id')->unsigned();
			$table->foreign('venue_id')->references('id')->on('venues');
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
		Schema::drop('points_of_interest');
	}

}
