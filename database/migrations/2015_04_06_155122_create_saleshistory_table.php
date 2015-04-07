<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleshistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saleshistory', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('articleID');
			$table->integer('userID');
			$table->integer('artistID');
			$table->integer('typeID');
			$table->integer('subtypeID');
			$table->integer('templateID');
			$table->string('title');
			$table->string('dimensions');
			$table->string('size');
			$table->string('style');
			$table->string('color');
			$table->integer('quantity');
			$table->decimal('price', 8, 2);
			$table->decimal('discount', 8, 2);
			$table->decimal('originalPrice', 8, 2);
			$table->timestamp('dateSold');
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
		Schema::table('saleshistory', function(Blueprint $table)
		{
			Schema::drop('saleshistory');
		});
	}

}
