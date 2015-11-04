<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhotos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('s3_url')->nullable();
			$table->integer('poi_id')->unsigned();
			$table->foreign('poi_id')->references('id')->on('points_of_interest');
			$table->integer('venue_id')->unsigned();
			$table->foreign('venue_id')->references('id')->on('venues');
			$table->integer('deal_id')->unsigned();
			$table->foreign('deal_id')->references('id')->on('deals');
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('events');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('post_id')->unsigned();
			$table->foreign('post_id')->references('id')->on('posts');
			$table->string('photo_source')->nullable(); // mapper, crawler, user, vendor
			$table->string('igestion_state')->nullable(); // use, do-not-use, unprocessed, separate-out
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
		Schema::drop('photos');
	}

}
