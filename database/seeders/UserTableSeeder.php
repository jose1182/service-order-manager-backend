<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$userRole = Role::where('slug', 'admin')->first();

        if(config('admin.admin_name')) {
            $user = User::firstOrCreate(
                [
                    'email' => config('admin.admin_email')
                ],
                [
                    'name' => config('admin.admin_name'),
                    'password' => Hash::make(config('admin.admin_password')),
                ]
            );

            //Get all roles
            $userRoles = Role::all();

            //set all roles to admin user
            foreach($userRoles as $role){
                $user->roles()->attach($role->id);
            }
        }
    }
}
