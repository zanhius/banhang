<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\VoucherController;

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
    return view('welcome');
});
Route::get('/',[CustomerLoginController::class , 'welcome'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('category')->group(function () {
    Route::name('category.')->group(function () {
        Route::get('san-pham', [SanPhamController::class, 'index'])->name('index');
        Route::get('add-san-pham', [SanPhamController::class, 'create'])->name('add-sp');
        Route::post('add-san-pham', [SanPhamController::class, 'store'])->name('add_san_pham');
        Route::get('edit-san-pham/{id}', [SanPhamController::class, 'edit']);
        Route::put('edit-san-pham/{id}', [SanPhamController::class, 'update'])->name('edit_san_pham');
        Route::delete('delete-san-pham/{id}', [SanPhamController::class, 'destroy'])->name('delete_san_pham');
    });
});
Route::prefix('voucher')->group(function () {
    Route::name('voucher.')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('index');
        Route::get('/add', [VoucherController::class, 'create']);
        Route::post('/add', [VoucherController::class, 'store'])->name('add_voucher');
        Route::get('/edit/{id}', [VoucherController::class, 'edit']);
        Route::put('/edit/{id}', [VoucherController::class, 'update'])->name('edit_voucher');
        Route::delete('/delete/{id}', [VoucherController::class, 'destroy'])->name('delete_voucher');
    });
});

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth:customer', 'verified'])->name('customer.dashboard');
require __DIR__.'/customerAuth.php';




require __DIR__.'/auth.php';
