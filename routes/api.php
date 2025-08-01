<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('customer_login',[AuthController::class, 'customer_login'])->name('customer_login');
Route::post('verify_otp',[AuthController::class, 'verify_otp'])->name('verify_otp');
Route::post('resend_otp',[AuthController::class, 'resend_otp'])->name('resend_otp');
Route::post('sign_up',[AuthController::class, 'sign_up'])->name('sign_up');
Route::post('profile_fetch',[AuthController::class, 'profile_fetch'])->name('profile_fetch');


Route::post('eventlist', [CommonController::class, 'eventlist'])->name('eventlist');
Route::post('geteventbyid', [CommonController::class, 'geteventbyid'])->name('geteventbyid');
Route::post('eventadd',[CommonController::class, 'saveevent'])->name('eventadd');
Route::post('eventedit',[CommonController::class, 'saveevent'])->name('eventedit');
Route::delete('eventdelete',[CommonController::class, 'eventdelete'])->name('eventdelete');

Route::post('getsubeventbyid', [CommonController::class, 'getsubeventbyid'])->name('getsubeventbyid');
Route::post('subeventadd',[CommonController::class, 'savesubevent'])->name('subeventadd');
Route::post('subeventedit',[CommonController::class, 'savesubevent'])->name('subeventedit');
Route::delete('subeventdelete',[CommonController::class, 'subeventdelete'])->name('subeventdelete');

Route::post('guestlist', [CommonController::class, 'guestlist'])->name('guestlist');
Route::post('guestadd',[CommonController::class, 'saveguest'])->name('guestadd');
Route::post('guestedit',[CommonController::class, 'saveguest'])->name('guestedit');
Route::delete('guestdelete',[CommonController::class, 'guestdelete'])->name('guestdelete');


Route::get('getguesttypelist', [CommonController::class, 'getguesttypelist'])->name('getguesttypelist');
Route::post('guesttypeadd', [CommonController::class, 'guesttypeadd'])->name('guesttypeadd');


Route::get('getcurrencylist', [CommonController::class, 'getcurrencylist'])->name('getcurrencylist');


Route::get('getprefixlist', [CommonController::class, 'getprefixlist'])->name('getprefixlist');
Route::post('saveprefixlist', [CommonController::class, 'saveprefixlist'])->name('saveprefixlist');

Route::post('vendorlist', [CommonController::class, 'vendorlist'])->name('vendorlist');
Route::post('vendorlistbyeventid', [CommonController::class, 'vendorlist'])->name('vendorlistbyeventid');
Route::post('getvendorbyid', [CommonController::class, 'getvendorbyid'])->name('getvendorbyid');
Route::post('vendoradd',[CommonController::class, 'savevendor'])->name('vendoradd');
Route::post('vendoredit',[CommonController::class, 'savevendor'])->name('vendoredit');
Route::delete('vendordelete',[CommonController::class, 'vendordelete'])->name('vendordelete');


Route::post('getbudgetlist', [CommonController::class, 'getbudgetlist'])->name('getbudgetlist');

Route::post('tasklist', [CommonController::class, 'tasklist'])->name('tasklist');
Route::post('tasklistbyeventid', [CommonController::class, 'tasklist'])->name('tasklistbyeventid');
Route::post('gettaskbyid', [CommonController::class, 'gettaskbyid'])->name('gettaskbyid');
Route::post('taskadd',[CommonController::class, 'savetask'])->name('taskadd');
Route::post('taskedit',[CommonController::class, 'savetask'])->name('taskedit');
Route::delete('taskdelete',[CommonController::class, 'taskdelete'])->name('taskdelete');

Route::post('taskstatus', [CommonController::class, 'taskstatus'])->name('taskstatus');

Route::get('tasklistsuggestion', [CommonController::class, 'tasklistsuggestion'])->name('tasklistsuggestion');


Route::get('statelist', [CommonController::class, 'statelist'])->name('statelist');
Route::post('districtlistbtstateid', [CommonController::class, 'districtlistbtstateid'])->name('districtlistbtstateid');
Route::post('subdistrictlistbydistrictid', [CommonController::class, 'subdistrictlistbydistrictid'])->name('subdistrictlistbydistrictid');