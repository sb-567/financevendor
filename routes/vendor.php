<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\LeadController;
use App\Http\Controllers\Vendor\CommonController;
use App\Http\Controllers\Vendor\PropertyController;
use App\Http\Controllers\Vendor\SubscribeController;

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
    

    
    Route::get('leadlist',[LeadController::class, 'index'])->name('agentlist');
    Route::post('leadview',[Leadcontroller::class, 'leadview'])->name('leadview');
    Route::get('getleadlistdata',[LeadController::class, 'getleadlistdata'])->name('getleadlistdata');
    Route::get('leadcreate',[LeadController::class, 'create'])->name('leadcreate');
    Route::post('leadsave',[LeadController::class, 'leadsave'])->name('leadsave');
    Route::get('leadedit/{id}',[LeadController::class, 'leadedit'])->name('leadedit');
    
    Route::delete('/leaddelete/{id}', [LeadController::class, 'destroy'])->name('leaddelete');
    Route::post('deleteselectedlead',[LeadController::class, 'selecteddestroy'])->name('deleteselectedlead');
    
    Route::get('profile',[CommonController::class, 'profile'])->name('profile');
    Route::post('updateprofile',[CommonController::class, 'updateprofile'])->name('updateprofile');
    Route::post('changepassword',[CommonController::class, 'changepassword'])->name('changepassword');


    
    Route::get('propertieslist',[PropertyController::class, 'index'])->name('propertieslist');
    Route::get('getpropertylistdata',[PropertyController::class, 'getpropertylistdata'])->name('getpropertylistdata');
    Route::get('propertiescreate',[PropertyController::class, 'create'])->name('propertiescreate');
    Route::post('propertiessave',[PropertyController::class, 'propertiessave'])->name('propertiessave');
    Route::get('propertiesedit/{id}',[PropertyController::class, 'propertiesedit'])->name('propertiesedit');
    
    Route::delete('/propertiesdelete/{id}', [PropertyController::class, 'destroy'])->name('propertiesdelete');
    Route::post('deleteselectedproperties',[PropertyController::class, 'selecteddestroy'])->name('deleteselectedproperties');
    

    Route::get('subcribtionplan',[SubscribeController::class, 'index'])->name('subcribtionplan');

    Route::post('getsubcriptiondetail', [SubscribeController::class, 'getsubcriptiondetail'])->name('getsubcriptiondetail');
    Route::post('createOrder', [SubscribeController::class, 'createOrder'])->name('createOrder');

    
});


});