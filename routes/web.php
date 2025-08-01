<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubeventController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\GuestController;

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
    
    // Route::get('vendor_list',action: [VendorsController::class, 'index'])->name('vendor_list');
    // Route::get('vendorlistdelete',[VendorsController::class, 'destory'])->name('vendorlistdelete');
    
    Route::get('vendorlist',[VendorsController::class, 'index'])->name('vendorlist');
    Route::get('vendorlistbyuserid/{user_id}',[VendorsController::class, 'vendorlistbyuserid'])->name('vendorlistbyuserid');
    Route::get('vendorlistbyeventid/{user_id}/{event_id}',[VendorsController::class, 'vendorlistbyeventid'])->name('vendorlistbyeventid');
    Route::get('getvendorlistdata',[VendorsController::class, 'getvendorlistdata'])->name('getvendorlistdata');
    Route::get('vendorcreate',[VendorsController::class, 'create'])->name('vendorcreate');
    Route::post('vendorsave',[VendorsController::class, 'vendorsave'])->name('vendorsave');
    Route::get('vendoredit/{id}',[VendorsController::class, 'vendoredit']);
    Route::post('vendorstatuschange',[VendorsController::class, 'vendorstatuschange'])->name('vendorstatuschange');
    Route::delete('/vendordelete/{id}', [VendorsController::class, 'destroy'])->name('vendordelete');
    Route::post('deleteselectedvendor',[VendorsController::class, 'selecteddestroy'])->name('deleteselectedvendor');

    Route::get('userlist',[UserController::class, 'index'])->name('userlist');
    Route::get('getuserlistdata',[UserController::class, 'getuserlistdata'])->name('getuserlistdata');
    Route::get('usercreate',[UserController::class, 'create'])->name('usercreate');
    Route::post('userstatuschange',[UserController::class, 'userstatuschange'])->name('userstatuschange');
    
    // Route::get('useractivity/{id}',[CommonController::class, 'useractivity'])->name('useractivity');


    Route::get('eventlist/{user_id}',[EventController::class, 'index'])->name('eventlist');
    Route::get('geteventlistdata',[EventController::class, 'geteventlistdata'])->name('geteventlistdata');
    Route::get('eventcreate',[EventController::class, 'create'])->name('eventcreate');
    Route::post('eventsave',[EventController::class, 'eventsave'])->name('eventsave');
    Route::get('eventedit/{id}',[EventController::class, 'eventedit']);
    Route::post('eventstatuschange',[EventController::class, 'eventstatuschange'])->name('eventstatuschange');
    Route::delete('/eventdelete/{id}', [EventController::class, 'destroy'])->name('eventdelete');
    Route::post('deleteselectedevent',[EventController::class, 'selecteddestroy'])->name('deleteselectedevent');
    
    
    
    Route::get('subeventlist/{event_id}/{user_id}',[SubeventController::class, 'index'])->name('subeventlist');
    Route::get('getsubeventlistdata',[SubeventController::class, 'getsubeventlistdata'])->name('getsubeventlistdata');
    Route::get('subeventcreate',[SubeventController::class, 'create'])->name('subeventcreate');
    Route::post('subeventsave',[SubeventController::class, 'subeventsave'])->name('subeventsave');
    Route::get('subeventedit/{id}',[SubeventController::class, 'subeventedit']);
    Route::post('subeventstatuschange',[SubeventController::class, 'subeventstatuschange'])->name('subeventstatuschange');
    Route::delete('/subeventdelete/{id}', [SubeventController::class, 'destroy'])->name('subeventdelete');
    Route::post('deleteselectedsubevent',[SubeventController::class, 'selecteddestroy'])->name('deleteselectedsubevent');
    Route::post('getsubeventbyid',[SubeventController::class, 'getsubeventbyid'])->name('getsubeventbyid');
    
    Route::get('guestlist/{user_id}',[GuestController::class, 'index'])->name('guestlist');
    Route::get('guestlistbyeventid/{event_id}/{user_id}',[GuestController::class, 'guestlistbyeventid'])->name('guestlistbyeventid');
    Route::get('getguestlistdata',[GuestController::class, 'getguestlistdata'])->name('getguestlistdata');
    Route::get('guestcreate',[GuestController::class, 'create'])->name('guestcreate');
    Route::post('guestsave',[GuestController::class, 'guestsave'])->name('guestsave');
    Route::get('guestedit/{id}',[GuestController::class, 'guestedit']);
    Route::post('gueststatuschange',[GuestController::class, 'gueststatuschange'])->name('gueststatuschange');
    Route::delete('/guestdelete/{id}', [GuestController::class, 'destroy'])->name('guestdelete');
    Route::post('deleteselectedguest',[GuestController::class, 'selecteddestroy'])->name('deleteselectedguest');
   

    
    Route::get('tasklist',[TaskController::class, 'index'])->name('tasklist');
    Route::get('gettasklistdata',[TaskController::class, 'gettasklistdata'])->name('gettasklistdata');
    Route::get('taskcreate',[TaskController::class, 'create'])->name('taskcreate');
    Route::post('tasksave',[TaskController::class, 'tasksave'])->name('tasksave');
    Route::get('taskedit/{id}',[TaskController::class, 'taskedit']);
    Route::post('taskstatuschange',[TaskController::class, 'taskstatuschange'])->name('taskstatuschange');
    Route::delete('/taskdelete/{id}', [TaskController::class, 'destroy'])->name('taskdelete');
    Route::post('deleteselectedtask',[TaskController::class, 'selecteddestroy'])->name('deleteselectedtask');
    
    Route::get('usertasklist/{user_id}',[TaskController::class, 'usertasklist'])->name('usertasklist');
    Route::get('getusertasklistdata',[TaskController::class, 'getusertasklistdata'])->name('getusertasklistdata');
    Route::get('usertaskcreate',[TaskController::class, 'usertaskcreate'])->name('usertaskcreate');
    Route::post('usertasksave',[TaskController::class, 'usertasksave'])->name('usertasksave');
    Route::get('usertaskedit/{id}',[TaskController::class, 'usertaskedit']);
    Route::post('usertaskstatuschange',[TaskController::class, 'usertaskstatuschange'])->name('usertaskstatuschange');
    Route::delete('/usertaskdelete/{id}', [TaskController::class, 'usertaskdelete'])->name('usertaskdelete');
    Route::post('deleteselectedusertask',[TaskController::class, 'selecteddestroy'])->name('deleteselectedusertask');
    
    
    Route::get('statelist',[StateController::class, 'index'])->name('statelist');
    Route::get('getstatelistdata',[StateController::class, 'getstatelistdata'])->name('getstatelistdata');
    Route::get('statecreate',[StateController::class, 'create'])->name('statecreate');
    Route::post('statesave',[StateController::class, 'statesave'])->name('statesave');
    Route::get('stateedit/{id}',[StateController::class, 'stateedit']);
    Route::post('statestatuschange',[StateController::class, 'statestatuschange'])->name('statestatuschange');
    Route::delete('/statedelete/{id}', [StateController::class, 'destroy'])->name('statedelete');
    Route::post('deleteselectedstate',[StateController::class, 'selecteddestroy'])->name('deleteselectedstate');
   


   
    Route::get('districtlist',[DistrictController::class, 'index'])->name('districtlist');
    Route::get('getdistrictlistdata',[DistrictController::class, 'getdistrictlistdata'])->name('getdistrictlistdata');
    Route::get('districtcreate',[DistrictController::class, 'create'])->name('districtcreate');
    Route::post('districtsave',[DistrictController::class, 'districtsave'])->name('districtsave');
    Route::get('districtedit/{id}',[DistrictController::class, 'districtedit']);
    Route::post('districtstatuschange',[DistrictController::class, 'districtstatuschange'])->name('districtstatuschange');
    Route::delete('/districtdelete/{id}', [DistrictController::class, 'destroy'])->name('districtdelete');
    Route::post('deleteselecteddistrict',[DistrictController::class, 'selecteddestroy'])->name('deleteselecteddistrict');
    
    
    Route::get('subdistrictlist',[DistrictController::class, 'subdistrictlist'])->name('subdistrictlist');
    Route::get('getsubdistrictlistdata',[DistrictController::class, 'getsubdistrictlistdata'])->name('getsubdistrictlistdata');
    Route::get('subdistrictcreate',[DistrictController::class, 'subdistrictcreate'])->name('subdistrictcreate');
    Route::post('subdistrictsave',[DistrictController::class, 'subdistrictsave'])->name('subdistrictsave');
    Route::get('subdistrictedit/{id}',[DistrictController::class, 'subdistrictedit']);
    Route::post('subdistrictstatuschange',[DistrictController::class, 'subdistrictstatuschange'])->name('subdistrictstatuschange');
    Route::delete('/subdistrictdelete/{id}', [DistrictController::class, 'subdistrictdelete'])->name('subdistrictdelete');
    Route::post('deleteselectedsubdistrict',[DistrictController::class, 'deleteselectedsubdistrict'])->name('deleteselectedsubdistrict');
    Route::post('getdistrict',[DistrictController::class, 'getdistrict'])->name('getdistrict');
    Route::post('getsubdistrict',[DistrictController::class, 'getsubdistrict'])->name('getsubdistrict');


    Route::get('prefixlist',[CommonController::class, 'index'])->name('prefixlist');
    Route::get('getprefixlistdata',[CommonController::class, 'getprefixlistdata'])->name('getprefixlistdata');
    Route::get('prefixcreate',[CommonController::class, 'create'])->name('prefixcreate');
    Route::post('prefixsave',[CommonController::class, 'prefixsave'])->name('prefixsave');
    Route::get('prefixedit/{id}',[CommonController::class, 'prefixedit']);
    Route::post('prefixstatuschange',[CommonController::class, 'prefixstatuschange'])->name('prefixstatuschange');
    Route::delete('/prefixdelete/{id}', [CommonController::class, 'destroy'])->name('prefixdelete');
    Route::post('deleteselectedprefix',[CommonController::class, 'selecteddestroy'])->name('deleteselectedprefix');
   


    Route::get('budgetlistbyuserid/{user_id}',[CommonController::class, 'budgetlistbyuserid'])->name('budgetlistbyuserid');
    Route::get('budgetlistbyeventid/{user_id}/{event_id}',[CommonController::class, 'budgetlistbyeventid'])->name('budgetlistbyeventid');
    Route::get('getbudgetlistdata',[CommonController::class, 'getbudgetlistdata'])->name('getbudgetlistdata');
   

    // Route::get('vendorlistbyuserid/{user_id}',[VendorsController::class, 'vendorlistbyuserid'])->name('vendorlistbyuserid');
    // Route::get('vendorlistbyeventid/{user_id}/{event_id}',[VendorsController::class, 'vendorlistbyeventid'])->name('vendorlistbyeventid');
   

    
});