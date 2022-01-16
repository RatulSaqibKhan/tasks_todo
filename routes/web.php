<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function() {
    Route::get('/', [AuthenticationController::class, 'application']);
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/signin', [AuthenticationController::class, 'signin'])->name('signin');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('login');
});

Route::middleware(['web', 'auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user-list');
    });
});