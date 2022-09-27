<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Prefixes Route group for Admin

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
    Route::resource('roles', RoleController::class);
});

require __DIR__ . '/auth.php';
