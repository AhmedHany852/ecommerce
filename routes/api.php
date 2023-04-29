<?php

use App\Http\Controllers\Api\productsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\middleware\CheckUserType;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum', CheckUserType::class)->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('products', productsController::class);
