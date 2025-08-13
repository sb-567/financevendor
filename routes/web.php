<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\VendorsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubeventController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AuthController::class, 'index']);
Route::post('login',[AuthController::class, 'login']);


Route::middleware(['guard'])->group(function(){
    
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('roles', RoleController::class);

    Route::get('rolelist',[RoleController::class, 'index'])->name(name: 'rolelist');
    Route::get('getrolelistdata',[RoleController::class, 'getrolelistdata'])->name('getrolelistdata');
    Route::get('rolecreate',[RoleController::class, 'create'])->name('rolecreate');
    Route::post('rolesave',[RoleController::class, 'store'])->name('rolesave');


    // Route::get('vendorlist',[VendorsController::class, 'index'])->name('vendorlist');
    // Route::get('vendorlistbyuserid/{user_id}',[VendorsController::class, 'vendorlistbyuserid'])->name('vendorlistbyuserid');
    // Route::get('vendorlistbyeventid/{user_id}/{event_id}',[VendorsController::class, 'vendorlistbyeventid'])->name('vendorlistbyeventid');
    // Route::get('getvendorlistdata',[VendorsController::class, 'getvendorlistdata'])->name('getvendorlistdata');
    // Route::get('vendorcreate',[VendorsController::class, 'create'])->name('vendorcreate');
    // Route::post('vendorsave',[VendorsController::class, 'vendorsave'])->name('vendorsave');
    // Route::get('vendoredit/{id}',[VendorsController::class, 'vendoredit']);
    // Route::post('vendorstatuschange',[VendorsController::class, 'vendorstatuschange'])->name('vendorstatuschange');
    // Route::delete('/vendordelete/{id}', [VendorsController::class, 'destroy'])->name('vendordelete');
    // Route::post('deleteselectedvendor',[VendorsController::class, 'selecteddestroy'])->name('deleteselectedvendor');



    
});