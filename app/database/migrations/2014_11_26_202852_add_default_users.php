<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$user = new Toddish\Verify\Models\User;
		$user->username = 'client';
		$user->email = 'client@xyz.com';
		$user->password = 'client123'; // This is automatically salted and encrypted
		$user->verified = 1;
		$user->save();

		$user->roles()->sync(array(1));

		$user = new Toddish\Verify\Models\User;
		$user->username = 'employee';
		$user->email = 'employee@xyz.com';
		$user->password = 'employee123'; // This is automatically salted and encrypted
		$user->verified =1;
		$user->save();

		$user->roles()->sync(array(3));

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
