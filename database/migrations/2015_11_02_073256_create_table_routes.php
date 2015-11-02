<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoutes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('origin_node_id')->unsigned();
			$table->foreign('origin_node_id')->references('id')->on('nodes');
			$table->integer('destination_node_id')->unsigned();
			$table->foreign('destination_node_id')->references('id')->on('nodes');
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
		Schema::drop('routes');
	}

}
