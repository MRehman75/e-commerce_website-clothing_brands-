<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware('auth')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('dashboard',[DashboardController::class,'index']);

    // Route::get('/users', function () {
    //     return view('admin.users');
    // });
    Route::get('/users',[UsersController::class,'index']);

    // Route::get('/products', function () {
    //     return view('admin.products');
    // });
    Route::get('/products',[ProductsController::class,'index']);

    // Route::get('/orders', function () {
    //     return view('admin.orders');
    // });
    Route::get('/orders',[OrdersController::class,'index']);

});





