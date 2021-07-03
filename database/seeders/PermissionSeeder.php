<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                "name" => "View technical Dashboard",
                "slug" => "view-technical-dashboard"
            ],
            [
                "name" => "View admin Dashboard",
                "slug" => "view-admin-dashboard"
            ]
        ]);
    }
}
