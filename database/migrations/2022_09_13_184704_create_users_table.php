<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
			$table->bigIncrements('id');
			$table->string('dni', 50)->unique();
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('email', 150)->unique();
			$table->string('address', 180);
			$table->integer('cell_phone')->unsigned();
			$table->string('country', 100);
			$table->bigInteger('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories');
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
		Schema::dropIfExists('users');
	}
}
