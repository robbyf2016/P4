<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function($table){

			$table->increments('id');
			$table->timestamps();

			$table->string('client_name',255);
			$table->string('address',255);
			$table->string('city',255);
			$table->char('state',2);
			$table->char('zip_code',5);

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}
