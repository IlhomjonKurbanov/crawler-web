<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNodeNeightbors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('node_neightbors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('path_id')->unsigned();
			$table->foreign('path_id')->references('id')->on('paths');
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
		Schema::drop('node_neightbors');
	}

}
