<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Toddish\Verify\Models\Role;
use Toddish\Verify\Models\Permission;

class AddRolesAndPermissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create new Permissions
		$permission = new Toddish\Verify\Models\Permission;
		$permission->name = 'admin';
		$permission->description = 'Everything';
		$permission->save();

		$permission = new Toddish\Verify\Models\Permission;
		$permission->name = 'read_only';
		$permission->description = 'Read Only Permission';
		$permission->save();

		$permission = new Toddish\Verify\Models\Permission;
		$permission->name = 'employee';
		$permission->description = 'Permission for employee role';
		$permission->save();

		// Create a new Role
		$role = new Toddish\Verify\Models\Role;
		$role->name = 'CSC_client';
		$role->description = 'CSC client role with read only permission'
		$role->level = 1;
		$role->save();

		$role = new Toddish\Verify\Models\Role;
		$role->name = 'CSC_Admin';
		$role->description = 'CSC Admin role with full permission'
		$role->level = 5;
		$role->save();

		$role = new Toddish\Verify\Models\Role;
		$role->name = 'CSC_Employee';
		$role->description = 'CSC employee role with RTM permissions'
		$role->level = 3;
		$role->save();

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
