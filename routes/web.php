<?php

use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\KhachHang\ChiTietDonHangController;
use App\Http\Controllers\KhachHang\HoaDonController;
use Illuminate\Support\Facades\Route;

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



Route::prefix('banhang')->middleware('auth.customer')->group(function (){
    Route::get('/', [HoaDonController::class, 'index'])->name('index_mua_hang');
    Route::post('/', [HoaDonController::class, 'muaHang'])->name('post_mua_hang');
    Route::get('/mua-hang/', [HoaDonController::class, 'create'])->name('get_mua_hang');
    Route::post('/mua-hang/', [HoaDonController::class, 'store'])->name('mua_hang');
    Route::get('/hoa-don', [HoaDonController::class, 'hoaDon'])->name('hoadon.index');
    Route::get('/chi-tiet-don-hang/{id}', [ChiTietDonHangController::class, 'show'])->name('chi-tiet-don-hang');
    Route::get('/hoadon', [ChiTietDonHangController::class, 'index'])->name('customer.don_hang');
});


Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth:customer', 'verified'])->name('customer.dashboard');


require __DIR__ . '/customer.php';
require __DIR__.'/auth.php';
