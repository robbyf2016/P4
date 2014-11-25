<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientOrderAssignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_order_assignment', function($table){

			$table->integer('client_id')->unsigned();
			$table->integer('service_id')->unsigned();

			#Define the foreign key between client_id and id in clients table

			$table->foreign('client_id')->references('id')->on('clients');
			$table->foreign('service_id')->references('id')->on('services');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_order_assignment');
	}

}
