<?php


use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\EmployeeSectionController;
use App\Http\Controllers\admin\RawMaterialController;
use App\Http\Controllers\admin\RawMaterialSectionController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/unauthorized-action', [AdminDashboardController::class, 'unauthorized'])->name('unauthorized.action');


    //Employee Section
    Route::get('/employee-section', [EmployeeSectionController::class, 'index'])->name('employee.section');
    Route::post('/employee-section-store', [EmployeeSectionController::class, 'store'])->name('employee.section.store');
    Route::put('/employee-section-update/{id}', [EmployeeSectionController::class, 'update'])->name('employee.section.update');
    Route::get('/employee-section-delete/{id}', [EmployeeSectionController::class, 'destroy'])->name('employee.section.destroy');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee-store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee-update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee-delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    //Customer Section
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customer-store', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer-update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer-delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    //Supplier Section
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier-store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::put('/supplier-update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/supplier-delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    //Color Section
    Route::get('/color', [ColorController::class, 'index'])->name('color');
    Route::post('/color-store', [ColorController::class, 'store'])->name('color.store');
    Route::put('/color-update/{id}', [ColorController::class, 'update'])->name('color.update');
    Route::get('/color-delete/{id}', [ColorController::class, 'destroy'])->name('color.destroy');

    //Product Category Section
    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('productCategory');
    Route::post('/product-category-store', [ProductCategoryController::class, 'store'])->name('productCategory.store');
    Route::put('/product-category-update/{id}', [ProductCategoryController::class, 'update'])->name('productCategory.update');
    Route::get('/product-category-delete/{id}', [ProductCategoryController::class, 'destroy'])->name('productCategory.destroy');

    //Raw Material Section
    Route::get('/raw-material-section', [RawMaterialSectionController::class, 'index'])->name('rawMaterialSection');
    Route::post('/raw-material-section-store', [RawMaterialSectionController::class, 'store'])->name('raw.material.section.store');
    Route::put('/raw-material-section-update/{id}', [RawMaterialSectionController::class, 'update'])->name('raw.material.section.update');
    Route::get('/raw-material-section-delete/{id}', [RawMaterialSectionController::class, 'destroy'])->name('raw.material.section.destroy');

    //Raw Material Section
    Route::get('/raw-material', [RawMaterialController::class, 'index'])->name('rawMaterial');
    Route::post('/raw-material-store', [RawMaterialController::class, 'store'])->name('raw.material.store');
    Route::put('/raw-material-update/{id}', [RawMaterialController::class, 'update'])->name('raw.material.update');
    Route::get('/raw-material-delete/{id}', [RawMaterialController::class, 'destroy'])->name('raw.material.destroy');

    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');

});

require __DIR__.'/auth.php';