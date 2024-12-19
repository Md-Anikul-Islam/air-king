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

            //Product Design
            'product-design-manage',
            //For Product Category
            'product-category-section-list',
            'product-category-section-create',
            'product-category-section-edit',
            'product-category-section-delete',

            //For Color
            'color-section-list',
            'color-section-create',
            'color-section-edit',
            'color-section-delete',

            //For Supplier
            'supplier-section-list',
            'supplier-section-create',
            'supplier-section-edit',
            'supplier-section-delete',



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

            //For Customer
            'customer-section-list',
            'customer-section-create',
            'customer-section-edit',
            'customer-section-delete',



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
