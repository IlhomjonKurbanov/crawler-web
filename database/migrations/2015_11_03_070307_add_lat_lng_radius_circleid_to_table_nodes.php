<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatLngRadiusCircleidToTableNodes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('points_of_interest', function ($table) {
		    $table->string('latitude')->nullable();
		    $table->string('longitude')->nullable();
		    $table->string('radius')->nullable();
		    $table->string('circle_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('points_of_interest', function ($table) {
		    $table->dropColumn(['latitude', 'longitude', 'radius', 'circle_id']);
		});
	}

}
