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
        Route::resource('product', ProductController::class);
    });
});
