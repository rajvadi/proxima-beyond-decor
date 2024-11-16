<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Artisan;

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

Route::post('product/code/search', [ProductController::class, 'searchCode'])->name('product.code.search');

Route::get('/run-db-backup', function () {
    // Clear the configuration and event cache
    Artisan::call('config:clear');
    Artisan::call('event:clear');

    // Optionally, recache config and events
    Artisan::call('config:cache');
    Artisan::call('event:cache');

    // Run Spatie's backup command for database only
    Artisan::call('backup:run', ['--only-db' => true]);

    // Capture the output of the backup command
    $output = Artisan::output();

    return response()->json([
        'message' => 'Database backup command executed.',
        'output' => $output,
    ]);
});

