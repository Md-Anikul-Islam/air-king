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

            //Product Request
            'product-request-list',
            'product-request-section-delete',

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

            //For Raw Material section
            'raw-material-section-list',
            'raw-material-section-create',
            'raw-material-section-edit',
            'raw-material-section-delete',

            //For Raw Material
            'raw-material-list',
            'raw-material-create',
            'raw-material-edit',
            'raw-material-delete',

            //Product Design
            'product-design-list',
            'product-design-create',
            'product-design-edit',
            'product-design-delete',



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

            //Production Section
            'production-manage',
            //For Block
            'block-section-list',
            'block-section-create',
            'block-section-edit',
            'block-section-delete',

            //For Unit
            'unit-section-list',
            'unit-section-create',
            'unit-section-edit',
            'unit-section-delete',

            //For Warehouse
            'wareHouse-section-list',
            'wareHouse-section-create',
            'wareHouse-section-edit',
            'wareHouse-section-delete',

            //For Brand
            'brand-section-list',
            'brand-section-create',
            'brand-section-edit',
            'brand-section-delete',

            // For Batch
            'batch-section-list',
            'batch-section-create',
            'batch-section-edit',
            'batch-section-delete',

            //For Production
            'production-section-list',
            'production-section-create',
            'production-section-edit',
            'production-section-delete',

            //For Expense
            'expense-manage',
            //For Expense Type
            'expenseType-section-list',
            'expenseType-section-create',
            'expenseType-section-edit',
            'expenseType-section-delete',

            //For Expense Section
            'expense-section-list',
            'expense-section-create',
            'expense-section-edit',
            'expense-section-delete',

            //For sale
            'sale-history-list',
            'account-setting',
            'production-should-out',


            //For Role and permission
            'role-and-permission-list',
            //Site Setting
            'site-setting',
            //Dashboard
            'login-log-list',
            'cart-list',


        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
