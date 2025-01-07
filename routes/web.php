<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TryoutController;

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
    Route::get('/manage-users', [ManageUsersController::class, 'loadManageUsers'])->name('admin.manage-users');
    Route::delete('/users/{id}', [ManageUsersController::class, 'deleteUser'])->name('admin.users.delete');
    Route::put('/users/{id}', [ManageUsersController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/users', [ManageUsersController::class, 'addUser'])->name('admin.users.add');
    Route::get('/manage-tryouts', [TryoutController::class, 'loadManageTryouts'])->name('admin.tryouts.index');
    Route::post('/tryouts', [TryoutController::class, 'addTryout'])->name('admin.tryouts.store');
    Route::put('/tryouts/{id}', [TryoutController::class, 'updateTryout'])->name('admin.tryouts.update');
    Route::delete('/tryouts/{id}', [TryoutController::class, 'deleteTryout'])->name('admin.tryouts.delete');
});
