<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Create Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);


        // 2. Create permission List as Array

        $permissions = [

            // Dashboard Permission
            "dashboard.view",

            // Blog Permissions
            "blog.Create",
            "blog.view",
            "blog.edit",
            "blog.delete",
            "blog.approve",

            // Admin Permissions
            "admin.Create",
            "admin.view",
            "admin.edit",
            "admin.delete",
            "admin.approve",

            // Role Permissions
            "role.Create",
            "role.view",
            "role.edit",
            "role.delete",
            "role.approve",

            // Profile Permissions
            "profile.view",
            "profile.edit",


        ];


        // 3. Creater & Assign Permissions

        for ($i = 0; $i < count($permissions); $i++) {
            // Create Permission
            $permission = Permission::create(['name' => $permissions[$i]]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }
}
