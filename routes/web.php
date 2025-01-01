<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');;
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/manage-users', function () {
    //     return view('admin.manage-users');
    // })->name('admin.manage-users');
    Route::get('/manage-users', [ManageUsersController::class, 'loadManageUsers'])->name('admin.manage-users');
});




