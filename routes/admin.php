<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::prefix('auth')->middleware('guest:admin')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //admin profile
        Route::post('change-password', [ProfileController::class, 'update_password'])->name('update.password');
        Route::get('profile', [ProfileController::class, 'profile'])->name('change.profile');
        Route::post('update-profile', [ProfileController::class, 'update_profile'])->name('update.profile');

        //product management
        Route::match(['get', 'post'],'product/attribute/{product}', [ProductController::class, 'getAttribute'])->name('product.attribute');
        Route::match(['get', 'post'],'product/image/{product}', [ProductController::class, 'getImage'])->name('product.image');
        Route::get('print/A4/{product}', [ProductController::class, 'printA4'])->name('product.printA4');
        Route::resource('product', ProductController::class);

        //print product code
        Route::match(['get', 'post'],'print/product-code', [ProductController::class, 'printProductCode'])->name('product.print');
    });
});
