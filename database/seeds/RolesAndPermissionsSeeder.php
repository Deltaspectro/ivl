<?php 
/*
|--------------------------------------------------------------------------
| Roles & Permissions Seeder
|--------------------------------------------------------------------------
|
| This Seeder class allows you to update and create Roles & Permissions 
| for the Laravel Entrust package. 
|
| USE -> php artisan db:seed --class=RolesAndPermissionsSeeder
| 
| https://github.com/thomasfw/RolesAndPermissionsSeeder
|
|--------------------------------------------------------------------------
| Make sure you update the namespaces for your User & Entrust models
|--------------------------------------------------------------------------
*/
use App\User;
use App\Role;
use App\Permission;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class RolesAndPermissionsSeeder extends Seeder {


    
	/**
	* Run the Seeder
	*
	* @return void
	*/
	public function run()
	{	
		
		$admin = new Role();
		$admin->name         = 'admin';
		$admin->display_name = 'User Administrator'; // optional
		$admin->description  = 'User is allowed to manage and edit other users'; // optional
		$admin->save();
	}
	
	
	
}