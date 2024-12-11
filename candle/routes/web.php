<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\StripeController;
//show
Route::get('/', function () {
    return view('components.Home');
});
Route::post('/', function () {
    return view('components.Home');
});
//Session
//Register
Route::get('/register',[RegisteredUserController::class, 'create'] );
Route::post('/register',[RegisteredUserController::class, 'store'] );
//login/out
Route::get('/login',[SessionController::class, 'create'] );
Route::post('/login',[SessionController::class, 'store'] );
Route::post('/logout',[SessionController::class, 'destroy'] );
//Product
Route::get('/', [ProductController::class, 'fetch'])->name('product.fetch');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
//inc/dec
Route::post('/increment', [CartController::class,'increment'])->name('cart.increment');
Route::post('/decrement', [CartController::class,'decrement'])->name('cart.decrement');
//Add
Route::post('/add-to-cart', [CartController::class,'addToCart'])->name('cart.add');
//Show
Route::get('components.Cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('components.Cart', [CartController::class, 'showCart'])->name('cart.show');
//Remove
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
//Details
Route::get('/cart/details', [CartController::class, 'showDetails'])->name('cart.details');
Route::post('/cart/details', [CartController::class, 'showDetails'])->name('cart.details');
Route::post('/cart/shipping', [CartController::class, 'saveShipping'])->name('cart.shipping');
//info
Route::post('components.Shipping', [InformationController::class, 'store'])->name('information.store');
Route::get('components.Shipping', [InformationController::class, 'store'])->name('information.store');
//Coupon
Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('applyCoupon');
//method
Route::post('/shipping/save', [MethodController::class, 'save'])->name('shipping.save');
//pay
Route::post('/components.Payment', function () {
    return view('components.Payment');})->name('pay.show');
Route::get('/components.Shipping', function () {
    return view('components.Shipping');})->name('shipping.show');
Route::post('payment', [PaymentController::class, 'store'])->name('payment.store');
//receipt
Route::get('pay', [PaymentController::class, 'receipt'])->name('receipt.show');
