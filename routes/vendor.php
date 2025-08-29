<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\DashboardController;

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

Route::get('/',[AuthController::class, 'index']);
Route::post('login',[AuthController::class, 'login']);
Route::get('verify',[AuthController::class, 'verify']);
Route::post('verifyotp',[AuthController::class, 'verifyotp'])->name('verifyotp');


Route::middleware(['guard'])->group(function(){
    
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    // Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');


    
});


});