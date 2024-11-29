<?php

use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get("/register", 'showRegistrationForm')->name("register");
        Route::post("/register", "registerUser")->name('register');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get("/login", "loginForm")->name('login');
        Route::post("/login", "loginUser")->name("login");
    });

    Route::get("/forgot-password", [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post("/forgot-password", [ForgotPasswordController::class, 'store'])->name("password.email");
    Route::get('/reset-password/{token}', [ResetPasswordController::class, "create"])->name("password.reset");
    Route::post('/password-update', [ResetPasswordController::class, "update"])->name("password.update");
});

Route::middleware('auth')->group(function () {
    Route::post("/logout", LogoutController::class)->name("logout");
    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware(['signed'])->name('verification.verify');
    Route::get('/email/verify', [EmailVerificationNotificationController::class, "notice"])->name('verification.notice');
    Route::post('/emailverification-notification', [EmailVerificationNotificationController::class, "resendEmailVerification"])->middleware('throttle:6,1')->name("verification.send");
});
