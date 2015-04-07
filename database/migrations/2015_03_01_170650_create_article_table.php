<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('artistID');
			$table->integer('typeID');
			$table->integer('subtypeID');
			$table->integer('templateID');
			$table->string('title');
			$table->text('description');
			$table->string('dimensions');
			$table->string('size');
			$table->string('style');
			$table->string('color');
			$table->integer('stock');
			$table->decimal('price', 8, 2);
			$table->boolean('sale');
			$table->string('tags');
			$table->integer('likes');
			$table->timestamp('dateAdded');
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
		Schema::table('articles', function(Blueprint $table)
		{
			Schema::drop('articles');
		});
	}

}
