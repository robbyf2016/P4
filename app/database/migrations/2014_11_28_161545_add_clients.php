<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClients extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$client = new Client();

    	$client->client_name = 'ACME widgets';
    	$client->address = '1234 Main Street';
    	$client->city = 'New York';
    	$client->state = 'NY';
    	$client->zip_code = '21233';
    	$client->save();

    	$client = new Client();

    	$client->client_name = 'James Hook';
    	$client->address = '15-17 Northern Avenue';
    	$client->city = 'Boston';
    	$client->state = 'MA';
    	$client->zip_code = '02210';
    	$client->save();

    	$client = new Client();

    	$client->client_name = 'Sweet';
    	$client->address = '0 Brattle Street';
    	$client->city = 'Cambridge';
    	$client->state = 'MA';
    	$client->zip_code = '02138';
    	$client->save();

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
