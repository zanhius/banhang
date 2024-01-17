<?php

use App\Http\Controllers\Customer\AuthenticatedSessionController;
use App\Http\Controllers\Customer\ConfirmablePasswordController;
use App\Http\Controllers\Customer\EmailVerificationNotificationController;
use App\Http\Controllers\Customer\EmailVerificationPromptController;
use App\Http\Controllers\Customer\NewPasswordController;
use App\Http\Controllers\Customer\PasswordController;
use App\Http\Controllers\Customer\PasswordResetLinkController;
use App\Http\Controllers\Customer\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileCustomerController;

Route::middleware('guest:customer')->group(function () {
    Route::get('customer', [AuthenticatedSessionController::class, 'index'])
        ->name('customer.index');

    Route::get('customer/login', [AuthenticatedSessionController::class, 'create'])
        ->name('customer.login');

    Route::post('customer/login', [AuthenticatedSessionController::class, 'store'])->name('post.customer.login');

    Route::get('customer/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('customer.password.request');

    Route::post('customer/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('customer.password.email');

    Route::get('customer/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('customer.password.reset');

    Route::post('customer/reset-password', [NewPasswordController::class, 'store'])
        ->name('customer.password.store');
});

Route::middleware('auth:customer')->group(function () {
    Route::get('customer/verify-email', EmailVerificationPromptController::class)
        ->name('customer.verification.notice');

    Route::get('customer/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('customer.verification.verify');

    Route::post('customer/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('customer.verification.send');

    Route::get('customer/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('customer.password.confirm');

    Route::post('customer/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('customer/password', [PasswordController::class, 'update'])->name('customer.password.update');

    Route::post('customer/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('customer.logout');
});

Route::middleware('auth:customer')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::name('customer.')->group(function () {
            Route::get('/profile', [ProfileCustomerController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileCustomerController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileCustomerController::class, 'destroy'])->name('profile.destroy');
        });
    });
});
