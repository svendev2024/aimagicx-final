<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign existing permissions
        $roleUser = Role::updateOrCreate(['name' => 'user']);
        $roleSubscriber = Role::updateOrCreate(['name' => 'subscriber']);
        $roleAdmin = Role::updateOrCreate(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

    }
}
