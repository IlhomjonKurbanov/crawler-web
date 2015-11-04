<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Venue;

class AddConerPointsToVenueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('venues', function($table)
		{
			$table->string('lat_top_left')->nullable();
			$table->string('lng_top_left')->nullable();

			$table->string('lat_top_right')->nullable();
			$table->string('lng_top_right')->nullable();

			$table->string('lat_bottom_left')->nullable();
			$table->string('lng_bottom_left')->nullable();

			$table->string('lat_bottom_right')->nullable();
			$table->string('lng_bottom_right')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('venues', function ($table) {
		    $table->dropColumn(['lat_top_left', 'lng_top_left', 'lat_top_right', 'lng_top_right', 'lat_bottom_left', 'lng_bottom_left', 'lat_bottom_right', 'lng_bottom_right']);
		});
	}

}
