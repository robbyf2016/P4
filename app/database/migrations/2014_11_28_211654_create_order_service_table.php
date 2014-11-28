<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderServiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_service', function($table){

			$table->integer('order_id')->unsigned();
			$table->integer('service_id')->unsigned();

			#Define the foreign key between client_id and id in clients table

			$table->foreign('order_id')->references('id')->on('orders');
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
		Schema::drop('order_service');
	}

}

