<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                "name" => "User",
                "slug" => "user"
            ],
            [
                "name" => "Admin",
                "slug" => "admin"
            ]]);

            $userRole = Role::user()->firstOrFail();
            $userPermissions = Permission::where('slug', ['view-technical-dashboard'])->get()->pluck('id')->toArray();
            $userRole->permissions()->sync($userPermissions);
    }
}
