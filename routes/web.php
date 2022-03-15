<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HolidayController;
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
        Route::get('/', [UserController::class, 'index'])->name('users.list');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('companies')->group(function() {
        Route::get('/', [CompanyController::class, 'index'])->name('companies.list');
        Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/store', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
    });

    Route::prefix('holidays')->group(function() {
        Route::get('/', [HolidayController::class, 'index'])->name('holidays.list');
        Route::get('/create', [HolidayController::class, 'create'])->name('holidays.create');
        Route::post('/store', [HolidayController::class, 'store'])->name('holidays.store');
        Route::get('/{holiday}/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
        Route::put('/{holiday}', [HolidayController::class, 'update'])->name('holidays.update');
        Route::delete('/{holiday}', [HolidayController::class, 'destroy'])->name('holidays.destroy');
    });
});