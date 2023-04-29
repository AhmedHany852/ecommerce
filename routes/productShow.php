<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Dashboard\profilController;
use App\Http\Controllers\Dashboard\ProductController;

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

//Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');


Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('products.show');