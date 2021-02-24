<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [OrderController::class, 'create'])->name('welcome');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/checkout/{orderNo}', [OrderController::class, 'orderSummary'])->name('order.summary');
Route::post('/payment/initialize/{order}', [PaymentController::class, 'initialize'])->name('payment.initialize');
Route::any('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');
Route::any('/payment/status/{payment}', [PaymentController::class, 'paymentStatus'])->name('payment.status');
