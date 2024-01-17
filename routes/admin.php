<?php

use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHang\HoaDonController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware(['auth', 'email.check'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/', [SanPhamController::class, 'admin'])->name('admin');
        Route::get('san-pham', [SanPhamController::class, 'index'])->name('index');
        Route::get('add-san-pham', [SanPhamController::class, 'create'])->name('add-sp');
        Route::post('add-san-pham', [SanPhamController::class, 'store'])->name('add_san_pham');
        Route::get('edit-san-pham/{id}', [SanPhamController::class, 'edit']);
        Route::put('edit-san-pham/{id}', [SanPhamController::class, 'update'])->name('edit_san_pham');
        Route::delete('delete-san-pham/{id}', [SanPhamController::class, 'destroy'])->name('delete_san_pham');
    });
    Route::name('voucher.')->group(function () {
        Route::get('/voucher', [VoucherController::class, 'index'])->name('index');
        Route::get('/add-voucher', [VoucherController::class, 'create'])->name('get_add_voucher');
        Route::post('/add-voucher', [VoucherController::class, 'store'])->name('add_voucher');
        Route::get('/voucher/edit/{id}', [VoucherController::class, 'edit']);
        Route::put('/voucher/edit/{id}', [VoucherController::class, 'update'])->name('edit_voucher');
        Route::delete('/voucher/delete/{id}', [VoucherController::class, 'destroy'])->name('delete_voucher');
    });
    Route::get('/don-hang', [HoaDonController::class, 'donHang'])->name('get_don_hang');
});

