<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use GuzzleHttp\Middleware;
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

Route::view('/login', 'auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/get-districts/{id}', [LocationController::class, 'getDistrict'])->name('getDistrict');
    Route::get('/get-gaupalaika/{id}', [LocationController::class, 'getGaupalika'])->name('getGaupalika');
    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('/customer', CustomerController::class);
    Route::resource('/staff', StaffController::class);
    Route::resource('/deposite', DepositeController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('categories', CategoryController::class);


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
