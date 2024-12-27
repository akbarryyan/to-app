<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout']);

    Route::get('/dashboard', function() {
        if (!session()->has('admin_id')) {
            echo "<script>alert('You must be logged in as an admin to access this page.');</script>";
            return redirect()->route('admin.login');
        }
        return app(AdminDashboardController::class)->index();
    })->name('admin.dashboard');
});




