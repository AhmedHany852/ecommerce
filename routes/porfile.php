<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard\profilController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('profile', [profilController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [profilController::class, 'update'])->name('profile.update');
});
