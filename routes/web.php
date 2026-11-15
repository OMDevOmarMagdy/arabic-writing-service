<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Redirect default login route to admin login (required for Laravel auth redirects)
Route::get('login', fn () => redirect()->route('admin.login'))->name('login');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    // Guest-only routes (login form)
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    });

    // Redirect /admin to dashboard
    Route::get('/', fn () => redirect()->route('admin.dashboard'));

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Services management
        Route::resource('services', AdminServiceController::class)
            ->except(['show'])
            ->names('admin.services');

        Route::patch('services/{service}/toggle-status', [AdminServiceController::class, 'toggleStatus'])
            ->name('admin.services.toggle-status');
    });
});
