<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesubtypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articlesubtypes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('typeID');
			$table->string('name');
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
		Schema::table('articlesubtypes', function(Blueprint $table)
		{
			Schema::drop('articlesubtypes');
		});
	}

}
