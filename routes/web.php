<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\DashboardController;

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConvertersController;
use App\Http\Controllers\Front\PaymentController;
use Illuminate\Support\Facades\Auth;
use App\Http\middleware\CheckUserType;
use Illuminate\Support\Facades\Hash;

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

Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home');
Route::post('/paypal/webhok', function () {
    echo 'web hook';
});
Route::resource('roles', RolesController::class);
Route::resource('cart', CartController::class);
Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);
Route::post('currency', [CurrencyConvertersController::class, 'store'])
    ->name('currency.store');
Route::post('orders/{order}/pay', [PaymentController::class, 'create'])->name('order.payments.create');
Route::post('orders/{order}/stripe/paymeny-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');
Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])->name('stripe.return');
// require __DIR__ . '/auth.php';
require __DIR__ . '/categories.php';
require __DIR__ . '/products.php';
require __DIR__ . '/porfile.php';
require __DIR__ . '/stores.php';
require __DIR__ . '/productShow.php';
