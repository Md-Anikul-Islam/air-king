<?php


use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\EmployeeSectionController;
use App\Http\Controllers\admin\ProductDesignController;
use App\Http\Controllers\admin\RawMaterialController;
use App\Http\Controllers\admin\RawMaterialSectionController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\BlockController;
use App\Http\Controllers\admin\BatchController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\UnitController;
use App\Http\Controllers\admin\WareHouseController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\ExpenseTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\admin\SellHistoryDetailsController;
use App\Http\Controllers\admin\ProductRequestController;
>>>>>>> Stashed changes
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

    //Product Design
    Route::get('/product-design', [ProductDesignController::class, 'index'])->name('product.design');
    Route::post('/product-design-store', [ProductDesignController::class, 'store'])->name('product.design.store');
    Route::put('/product-design-update/{id}', [ProductDesignController::class, 'update'])->name('product.design.update');
    Route::get('/product-design-delete/{id}', [ProductDesignController::class, 'destroy'])->name('product.design.destroy');

    //Block
    Route::get('/block', [BlockController::class, 'index'])->name('block');
    Route::post('/block-store', [BlockController::class, 'store'])->name('block.store');
    Route::put('/block-update/{id}', [BlockController::class, 'update'])->name('block.update');
    Route::get('/block-delete/{id}', [BlockController::class, 'destroy'])->name('block.destroy');

    //Unit
    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::post('/unit-store', [UnitController::class, 'store'])->name('unit.store');
    Route::put('/unit-update/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::get('/unit-delete/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');

    //Warehouse
    Route::get('/wareHouse', [WareHouseController::class, 'index'])->name('wareHouse');
    Route::post('/wareHouse-store', [WareHouseController::class, 'store'])->name('wareHouse.store');
    Route::put('/wareHouse-update/{id}', [WareHouseController::class, 'update'])->name('wareHouse.update');
    Route::get('/wareHouse-delete/{id}', [WareHouseController::class, 'destroy'])->name('wareHouse.destroy');
    Route::get('/get-units/{block_id}', [WareHouseController::class, 'getUnits'])->name('get.units');

    //Brands
    Route::get('/brand', [BrandController::class, 'index'])->name('brand');
    Route::post('/brand-store', [BrandController::class, 'store'])->name('brand.store');
    Route::put('/brand-update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/brand-delete/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

    //Brands
    Route::get('/batch', [BatchController::class, 'index'])->name('batch');
    Route::post('/batch-store', [BatchController::class, 'store'])->name('batch.store');
    Route::put('/batch-update/{id}', [BatchController::class, 'update'])->name('batch.update');
    Route::get('/batch-delete/{id}', [BatchController::class, 'destroy'])->name('batch.destroy');

    //Expense Types
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
    Route::post('/expense-store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::put('/expense-update/{id}', [ExpenseController::class, 'update'])->name('expense.update');
    Route::get('/expense-delete/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');

    //Expense Types
    Route::get('/expenseType', [ExpenseTypeController::class, 'index'])->name('expenseType');
    Route::post('/expenseType-store', [ExpenseTypeController::class, 'store'])->name('expenseType.store');
    Route::put('/expenseType-update/{id}', [ExpenseTypeController::class, 'update'])->name('expenseType.update');
    Route::get('/expenseType-delete/{id}', [ExpenseTypeController::class, 'destroy'])->name('expenseType.destroy');

    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');


    //Production
    Route::get('/product-request', [ProductRequestController::class, 'index'])->name('product.request');

});

require __DIR__.'/auth.php';
