<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\Leadcontroller;
use App\Http\Controllers\Vendor\CommonController;

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


Route::prefix('vendors')->name('vendors.')->group(function () {

Route::get('/',[AuthController::class, 'index'])->name('login');
Route::post('vlogin',[AuthController::class, 'vlogin'])->name('vlogin');
Route::get('verify',[AuthController::class, 'verify'])->name('verify');
Route::post('verifyotp',[AuthController::class, 'verifyotp'])->name('verifyotp');

Route::get('vregister',[AuthController::class, 'vregister'])->name('vregister');
Route::post('vregistersave',[AuthController::class, 'vregistersave'])->name('vregistersave');

Route::middleware(['vendor'])->group(function(){
    
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    

    
    Route::get('leadlist',[Leadcontroller::class, 'index'])->name('agentlist');
    Route::get('getleadlistdata',[Leadcontroller::class, 'getleadlistdata'])->name('getleadlistdata');
    Route::get('leadcreate',[Leadcontroller::class, 'create'])->name('leadcreate');
    Route::post('leadsave',[Leadcontroller::class, 'leadsave'])->name('leadsave');
    Route::get('leadedit/{id}',[Leadcontroller::class, 'leadedit'])->name('leadedit');
    
    Route::delete('/leaddelete/{id}', [Leadcontroller::class, 'destroy'])->name('leaddelete');
    Route::post('deleteselectedlead',[Leadcontroller::class, 'selecteddestroy'])->name('deleteselectedlead');
    
    Route::get('profile',[CommonController::class, 'profile'])->name('profile');
    Route::post('updateprofile',[CommonController::class, 'updateprofile'])->name('updateprofile');



    
});


});