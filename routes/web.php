<?php


use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\EmployeeSectionController;
use App\Http\Controllers\admin\SiteSettingController;
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



    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');

});

require __DIR__.'/auth.php';
