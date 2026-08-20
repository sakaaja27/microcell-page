<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SchemaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/admin/product', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/admin/product/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/product/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/skema-harga', [SchemaController::class, 'index'])->name('admin.schemas');
    Route::post('/admin/skema-harga', [SchemaController::class, 'store'])->name('admin.schemas.store');
    Route::put('/admin/skema-harga/{schema}', [SchemaController::class, 'update'])->name('admin.schemas.update');
    Route::delete('/admin/skema-harga/{schema}', [SchemaController::class, 'destroy'])->name('admin.schemas.destroy');

    Route::get('/admin/pesanan', [OrderController::class, 'index'])->name('admin.orders');
    Route::post('/admin/pesanan', [OrderController::class, 'store'])->name('admin.orders.store');
    Route::put('/admin/pesanan/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::put('/admin/pesanan/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::delete('/admin/pesanan/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin.customers');
    Route::post('/admin/customer', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::put('/admin/customer/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/admin/customer/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    Route::get('/admin/metode-pembayaran', [PaymentMethodController::class, 'index'])->name('admin.payments');
    Route::post('/admin/metode-pembayaran', [PaymentMethodController::class, 'store'])->name('admin.payments.store');
    Route::put('/admin/metode-pembayaran/{payment}', [PaymentMethodController::class, 'update'])->name('admin.payments.update');
    Route::delete('/admin/metode-pembayaran/{payment}', [PaymentMethodController::class, 'destroy'])->name('admin.payments.destroy');
});