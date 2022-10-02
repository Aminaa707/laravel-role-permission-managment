<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Auth\PasswordResetLinkController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('backend.auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Prefixes Route group for Admin

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
    Route::resource('roles', RoleController::class, ['names' => 'admin.roles']);
    Route::resource('users', UserController::class, ['names' => 'admin.users']);
    Route::resource('admins', AdminController::class, ['names' => 'admin.admins']);

    // Login Routes

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');

    Route::post('/login/submit', [AuthenticatedSessionController::class, 'store'])->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', [PasswordResetLinkController::class, 'create'])->name('admin.password.request');

    Route::post('/password/reset/submit', [PasswordResetLinkController::class, 'store'])->name('admin.password.update');
});



require __DIR__ . '/auth.php';

 
// php artisan optimize