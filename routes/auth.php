<?php

declare(strict_types=1);

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/forgot-password', [Auth\PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [Auth\PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [Auth\NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [Auth\NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [Auth\EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [Auth\VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [Auth\EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [Auth\ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [Auth\ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

Route::post('/logout', [Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/welcome/{user}', [Auth\WelcomeUserController::class, 'create'])
    ->name('welcome');

Route::post('/welcome/{user}', [Auth\WelcomeUserController::class, 'store']);
