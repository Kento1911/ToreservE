<?php

use App\Http\Controllers\Trainer\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Trainer\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Trainer\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Trainer\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Trainer\Auth\NewPasswordController;
use App\Http\Controllers\Trainer\Auth\PasswordResetLinkController;
use App\Http\Controllers\Trainer\Auth\RegisteredUserController;
use App\Http\Controllers\Trainer\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:trainers')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:trainers');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest:trainers')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest:trainers');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest:trainers')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:trainers')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:trainers')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:trainers')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:trainers', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:trainers', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:trainers')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:trainers');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:trainers')
                ->name('logout');
