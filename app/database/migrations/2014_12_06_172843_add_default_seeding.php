<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Toddish\Verify\Models\User;
use Toddish\Verify\Models\Permission;
use Toddish\Verify\Models\Role;


class AddDefaultSeeding extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*****************************************************************/
		//Create and assign for CSC Admin
		/*****************************************************************/
		$permission = new Toddish\Verify\Models\Permission;
		$permission->name = 'admin';
		$permission->description = 'Everything';
		$permission->save();

		$role = new Toddish\Verify\Models\Role;
		$role->name = 'CSC_Admin';
		$role->description = 'CSC Admin role with full permission';
		$role->level = 5;
		$role->save();

		$role->permissions()->sync(array($permission->id));

		$user = new Toddish\Verify\Models\User;
		$user->username = 'admin';
		$user->email = 'admin@xyz.com';
		$user->password = 'admin123'; // This is automatically salted and encrypted
		$user->verified =1;
		$user->save();

		$user->roles()->sync(array($role->id));

		/*****************************************************************/
		//Create and assign for CSC Employee
		/*****************************************************************/
		$permission = new Toddish\Verify\Models\Permission;
		$permission->name = 'employee';
		$permission->description = 'Permission for employee role';
		$permission->save();

		$role = new Toddish\Verify\Models\Role;
		$role->name = 'CSC_Employee';
		$role->description = 'CSC employee role with RTM permissions';
		$role->level = 3;
		$role->save();

		$role->permissions()->sync(array($permission->id));

		$user = new Toddish\Verify\Models\User;
		$user->username = 'employee';
		$user->email = 'employee@xyz.com';
		$user->password = 'employee123'; // This is automatically salted and encrypted
		$user->verified =1;
		$user->save();

		$user->roles()->sync(array($role->id));


		/*****************************************************************/
		//Create and assign for CSC Client
		/*****************************************************************/
		$permission = new Toddish\Verify\Models\Permission;
		$permission->name = 'read_only';
		$permission->description = 'Read Only Permission';
		$permission->save();

		$role = new Toddish\Verify\Models\Role;
		$role->name = 'CSC_client';
		$role->description = 'CSC client role with read only permission';
		$role->level = 1;
		$role->save();

		$role->permissions()->sync(array($permission->id));

		$user = new Toddish\Verify\Models\User;
		$user->username = 'client';
		$user->email = 'client@xyz.com';
		$user->password = 'client123'; // This is automatically salted and encrypted
		$user->verified = 1;
		$user->save();

		$user->roles()->sync(array($role->id));
	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//delete from users;
	}

}
