<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordConfirmController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;


Route::middleware('guest')->group(function () {

    /* -------------------- Register -------------------- */
    Route::get('/register' , [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    /* -------------------- Login -------------------- */
    Route::get('/login', [AuthenticateController::class, 'create'])->name('login');
    Route::post('login', [AuthenticateController::class, 'store']);

    /* -------------------- Reset Password -------------------- */
    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])
        ->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    /* -------------------- Logout -------------------- */
    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');

    /* -------------------- Email verification -------------------- */
    Route::get('/email/verify', [EmailVerificationController::class, 'notice']
    )->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])
        ->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('auth', 'throttle:1,1')->name('verification.send');

    /* -------------------- Password Confirmation -------------------- */
    Route::get('/confirm-password', [PasswordConfirmController::class, 'create'])
        ->name('password.confirm');

    Route::post('/confirm-password', [PasswordConfirmController::class, 'store'])
        ->middleware( 'throttle:3,1');
});
