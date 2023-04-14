<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceListController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\VehicleListController;
use App\Http\Controllers\BookingListController;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// // User Route
// Route::prefix('user')->group(function () {
//     Route::get("/home",[HomeController::class,'userHome'])->name('home');
// })->middleware('auth','user-role:user');

// // superadmin Route
// Route::prefix('superadmin')->group(function () {
//     Route::get("/home",[HomeController::class,'superadminHome'])->name('home.superadmin');
//     Route::resource("/serviceList" , ServiceListController::class);
// })->middleware('auth','user-role:superadmin');

// // Admin Route
// Route::prefix('admin')->group(function () {
//     Route::get("/home",[HomeController::class,'adminHome'])->name('home.admin');
//     Route::resource("/shops" , ShopController::class);
//     Route::resource("/service" , ServiceController::class);
// })->middleware('auth','user-role:admin');

Auth::routes();
// User Route
Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[HomeController::class,'userHome'])->name('home');
    Route::get("/shops" , [ShopController::class,'userShop'])->name('shops.userShop');
    Route::get("/shops/{shop}" , [ShopController::class,'userShopView'])->name('shops.userShopView');
    Route::get('/getServices', [ServiceController::class, 'getServices'])->name('getServices');
    Route::post('/processServices', [ServiceController::class, 'processServices'])->name('processServices');
    Route::resource('/bookingList', BookingListController::class);
});

// superadmin Route
Route::middleware(['auth','user-role:superadmin'])->group(function()
{
    Route::get("/superadmin/home",[HomeController::class,'superadminHome'])->name('home.superadmin');
    Route::resource('/superadmin/shops', ShopController::class);
    Route::resource("/superadmin/serviceList" , ServiceListController::class);
    Route::resource("/superadmin/vehicleList" , VehicleListController::class);
});

// Admin Route
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[HomeController::class,'adminHome'])->name('home.admin');
    Route::get("/admin/shops" , [ShopController::class,'myShop'])->name('shops.myShop');
    Route::put("/admin/shops/{shop}" , [ShopController::class,'myShopUpdate'])->name('shops.myShopUpdate');
    Route::resource("/admin/services" , ServiceController::class);
    // Route::resource("/service" , ServiceController::class);
});