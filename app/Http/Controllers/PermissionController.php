<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use App\User;

class PermissionController extends Controller
{
    public function Permission()
    {   
    	$admin_permission = Permission::where('slug','create')->first();
		$manager_permission = Permission::where('slug', 'edit')->first();
		$RegStd_permission = Permission::where('slug', 'edit')->first();

		//RoleTableSeeder.php
		$admin_role = new Role();
		$admin_role->slug = 'Admin';
		$admin_role->name = 'Administration';
		$admin_role->save();
		$admin_role->permissions()->attach($admin_permission);

		$manager_role = new Role();
		$manager_role->slug = 'manager';
		$manager_role->name = 'Assistant Manager';
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

		$student_role = new Role();
		$student_role->slug = 'Std';
		$student_role->name = 'student';
		$student_role->save();
		$student_role->permissions()->attach($RegStd_permission);


		$admin_role = Role::where('slug','Admin')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$std_role = Role::where('slug', 'Std')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($admin_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);
		$editUsers->roles()->attach($std_role);

		$admin_role = Role::where('slug','Admin')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$admin_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit')->first();

		$administrator = new User();
        $administrator->name = 'Thalathai singwong';
        $administrator->username = 'AdminDev';
		$administrator->email = 'Admin@gmail.com';
		$administrator->password = bcrypt('asdfghDEV');
		$administrator->save();
		$administrator->roles()->attach($admin_role);
		$administrator->permissions()->attach($admin_perm);

		$manager = new User();
		$manager->name = 'Mr.Zero';
        $manager->email = 'Zero@gmail.com';
        $manager->username = 'Zero';
		$manager->password =  bcrypt('asdfghZERO');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		
		return redirect()->back();
    }
}
