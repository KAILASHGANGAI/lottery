<?php

use App\Http\Controllers\AgentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\DepositedController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LotteryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
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
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile/{id}', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/get-districts/{id}', [LocationController::class, 'getDistrict'])->name('getDistrict');
    Route::get('/get-gaupalaika/{id}', [LocationController::class, 'getGaupalika'])->name('getGaupalika');
    Route::get('/',[DashboardController::class, 'index'])->name('home');

    Route::resource('/customer', CustomerController::class);
    Route::get('/customer-ajax', [CustomerController::class, 'customerAjax'])->name('customer.ajax');
    Route::get('/get-options/{customerName}', [CustomerController::class, 'getOptions']);
    Route::post('/get-customer', [CustomerController::class, 'getcustomer']);

    Route::resource('/staff', StaffController::class);
    Route::resource('/deposite', DepositeController::class);
    Route::resource('/deposited', DepositedController::class);
    Route::get('/deposited-bill/{id}', [DepositedController::class, 'bill'])->name('deposited.bill');
    Route::resource('/products', ProductController::class);
    Route::post('/products-search', [ProductController::class, 'search'])->name('product.search');
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/point-of-sale', [PosController::class, 'index'])->name('pos');
    Route::get('/getcard', [PosController::class, 'getcard'])->name('getcard');
    Route::post('/add-to-cart/{product}', [PosController::class, 'addToCart'])->name('addToCart');
    Route::post('/update-quantity/{id}', [PosController::class, 'quantityUpdate']);
    Route::delete('/remove-from-cart/{id}', [PosController::class, 'removeFromCart']);
    Route::post('/checkout', [PosController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/bill', [PosController::class, 'showBill'])->name('checkout.bill');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('settings', SettingController::class);
    Route::resource('fine', FineController::class);
    Route::resource('lottery', LotteryController::class);
    Route::resource('agents', AgentsController::class);
    Route::get('/get-agents/{search}', [AgentsController::class, 'search']);

    Route::get('/customer-report', [ReportController::class, 'index'])->name('customer.report');
    Route::post('/customer-report', [ReportController::class, 'search'])->name('searchreport');
    Route::get('/agent-report', [ReportController::class, 'agent'])->name('agent.report');
    Route::post('/agent-report', [ReportController::class, 'agentsearch'])->name('agentsearchreport');
    Route::get('/date-report', [ReportController::class, 'date'])->name('date.report');
    Route::post('/date-report', [ReportController::class, 'datesearch'])->name('datesearchreport');
    Route::get('/search-customer', [CustomerController::class, 'searchCustomer'])->name('searchCustomer');

});
