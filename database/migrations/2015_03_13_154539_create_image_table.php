<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('articleID');
			$table->integer('weight');
			$table->string('name');
			$table->string('url');
			$table->string('url100x100');
			$table->string('url200x200');
			$table->string('url500W');
			$table->boolean('visible');
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
		Schema::table('images', function(Blueprint $table)
		{
			Schema::drop('images');
		});
	}

}
