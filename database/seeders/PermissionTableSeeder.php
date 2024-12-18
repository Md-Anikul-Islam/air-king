<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            //For roll and permission
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            //For User
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',


            //Employee Section of hr management
            'hr-section-list',
            'employee-section-list',
            'employee-section-create',
            'employee-section-edit',
            'employee-section-delete',

            //Employee of hr management
            'employee-list',
            'employee-create',
            'employee-edit',
            'employee-delete',



            //For Role and permission
            'role-and-permission-list',
            //Site Setting
            'site-setting',
            //Dashboard
            'login-log-list',


        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
