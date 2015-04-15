<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type')->default('user');
			$table->string('name');
			$table->string('email');
			$table->string('cart');
			$table->string('wishlist');
			$table->string('likes');
			$table->string('follow');
			$table->string('history');
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamp('dateJoined');
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
		Schema::drop('users');
	}

}
