<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
    $products = Product::all();
    return view('welcome', compact('products'));
});



Route::prefix('admin')->group(function () {
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth'])->name('dashboard');

        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
        Route::post('category/onChange', [CategoryController::class, 'onChange'])->name('category.onChange');
    });
});

require __DIR__.'/auth.php';
