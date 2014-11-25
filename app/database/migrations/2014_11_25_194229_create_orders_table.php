<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($table){

			$table->increments('id');
			$table->timestamps();

			$table->integer('client_id')->unsigned();
			$table->date('order_created_date');

			#Define the foreign key between client_id and id in clients table

			$table->foreign('client_id')->references('id')->on('clients');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
