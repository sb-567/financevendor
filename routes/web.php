<?php

use App\Http\Controllers\Admin\Announcement;
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
use App\Http\Controllers\Admin\Leadcontroller;
use App\Http\Controllers\Admin\SubscribeController;
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
Route::get('verify',[AuthController::class, 'verify']);
Route::post('verifyotp',[AuthController::class, 'verifyotp'])->name('verifyotp');


Route::middleware(['guard'])->group(function(){
    
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('roles', RoleController::class);

    Route::get('rolelist',[RoleController::class, 'index'])->name('rolelist');
    Route::get('getrolelistdata',[RoleController::class, 'getrolelistdata'])->name('getrolelistdata');
    Route::get('rolecreate',[RoleController::class, 'create'])->name('rolecreate');
    Route::get('roleedit/{id}',[RoleController::class, 'edit']);
    Route::post('rolesave',[RoleController::class, 'store'])->name('rolesave');


    Route::get('userlist',[AuthController::class, 'userlist'])->name('userlist');
    Route::get('getuserlistdata',[AuthController::class, 'getuserlistdata'])->name('getuserlistdata');
    Route::post('userstatuschange',[AuthController::class, 'userstatuschange'])->name('userstatuschange');
    Route::delete('userdelete/{id}',[AuthController::class, 'destroy'])->name('userdelete');
    Route::post('deleteselectedvendor',[AuthController::class, 'selecteddestroy'])->name('deleteselectedvendor');
    Route::get('usercreate',[AuthController::class, 'create'])->name('usercreate');
    Route::get('useredit/{id}',[AuthController::class, 'useredit']);
    Route::post('usersave',[AuthController::class, 'usersave'])->name('usersave');
    
    
    Route::get('announcementlist',[Announcement::class, 'index'])->name('announcementlist');
    Route::get('getannouncementlistdata',[Announcement::class, 'getannouncementlistdata'])->name('getannouncementlistdata');
    Route::post('announcementstatuschange',[Announcement::class, 'announcementstatuschange'])->name('announcementstatuschange');
    Route::delete('announcementdelete/{id}',[Announcement::class, 'destroy'])->name('announcementdelete');
    Route::post('deleteselectedannouncement',[Announcement::class, 'selecteddestroy'])->name('deleteselectedannouncement');
    Route::get('announcementcreate',[Announcement::class, 'create'])->name('announcementcreate');
    Route::get('announcementedit/{id}',[Announcement::class, 'announcementedit']);
    Route::post('announcementsave',[Announcement::class, 'announcementsave'])->name('announcementsave');


  
    Route::get('communication', function () {
        return  "Welcome to the Admin Dashboard"; 
    });
    Route::get('subscription', function () {
        return  "Welcome to the Admin Dashboard"; 
    });
 
 
    Route::get('vendorlist',[VendorsController::class, 'index'])->name('vendorlist');
    Route::get('getvendorlistdata',[VendorsController::class, 'getvendorlistdata'])->name('getvendorlistdata');
    Route::get('vendorcreate',[VendorsController::class, 'create'])->name('vendorcreate');
    Route::post('vendorsave',[VendorsController::class, 'vendorsave'])->name('vendorsave');
    Route::get('vendoredit/{id}',[VendorsController::class, 'vendoredit']);
    Route::post('vendorstatuschange',[VendorsController::class, 'vendorstatuschange'])->name('vendorstatuschange');
    Route::delete('/vendordelete/{id}', [VendorsController::class, 'destroy'])->name('vendordelete');
    Route::post('deleteselectedvendor',[VendorsController::class, 'selecteddestroy'])->name('deleteselectedvendor');


    Route::get('leadlist',[Leadcontroller::class, 'index'])->name('vendorlist');
    Route::get('getleadlistdata',[Leadcontroller::class, 'getleadlistdata'])->name('getleadlistdata');
    Route::get('leadcreate',[Leadcontroller::class, 'create'])->name('leadcreate');
    Route::post('leadsave',[Leadcontroller::class, 'leadsave'])->name('leadsave');
    Route::post('exportlead',[Leadcontroller::class, 'exportlead'])->name('exportlead');
    Route::get('leadedit/{id}',[Leadcontroller::class, 'leadedit']);
    Route::post('leadstatuschange',[Leadcontroller::class, 'leadstatuschange'])->name('leadstatuschange');
    Route::delete('/leaddelete/{id}', [Leadcontroller::class, 'destroy'])->name('leaddelete');
    Route::post('deleteselectedlead',[Leadcontroller::class, 'selecteddestroy'])->name('deleteselectedlead');

    Route::get('plandescriptionlist',[SubscribeController::class, 'plandescriptionlist'])->name('plandescriptionlist');
    Route::get('getplandescriptiondata',[SubscribeController::class, 'getplandescriptiondata'])->name('getplandescriptiondata');
    Route::get('plandescriptioncreate',[SubscribeController::class, 'plandescriptioncreate'])->name('plandescriptioncreate');
    Route::post('plandescriptionsave',[SubscribeController::class, 'plandescriptionsave'])->name('plandescriptionsave');
    Route::get('plandescriptionedit/{id}',[SubscribeController::class, 'plandescriptionedit']);
    Route::post('plandescriptionstatuschange',[SubscribeController::class, 'plandescriptionstatuschange'])->name('plandescriptionstatuschange');
    Route::delete('/plandescriptiondelete/{id}', [SubscribeController::class, 'plandescriptiondelete'])->name('plandescriptiondelete');
    Route::post('deleteselectedplandescription',[SubscribeController::class, 'deleteselectedplandescription'])->name('deleteselectedplandescription');
    
    
    Route::get('subscriptionplanlist',[SubscribeController::class, 'subscriptionplanlist'])->name('subscriptionplanlist');
    Route::get('getsubscriptionplandata',[SubscribeController::class, 'getsubscriptionplandata'])->name('getsubscriptionplandata');
    Route::get('subscriptionplancreate',[SubscribeController::class, 'subscriptionplancreate'])->name('subscriptionplancreate');
    Route::post('subscriptionplansave',[SubscribeController::class, 'subscriptionplansave'])->name('subscriptionplansave');
    Route::get('subscriptionplanedit/{id}',[SubscribeController::class, 'subscriptionplanedit']);
    Route::post('subscriptionplanstatuschange',[SubscribeController::class, 'subscriptionplanstatuschange'])->name('subscriptionplanstatuschange');
    Route::delete('/subscriptionplandelete/{id}', [SubscribeController::class, 'subscriptionplandelete'])->name('subscriptionplandelete');
    Route::post('deleteselectedsubscriptionplan',[SubscribeController::class, 'deleteselectedsubscriptionplan'])->name('deleteselectedsubscriptionplan');



    
});