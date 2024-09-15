<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;

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

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('search', [ProductController::class, 'search'])->name('search');

Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');

