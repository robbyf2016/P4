<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Toddish\Verify\Models\Role;
use Toddish\Verify\Models\Permission;

class UpdatePermissionRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$role = Role::find(2);

		$role->permissions()->sync(array(1));

		$role = Role::find(1);

		$role->permissions()->sync(array(2));

		$role = Role::find(3);

		$role->permissions()->sync(array(3));
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