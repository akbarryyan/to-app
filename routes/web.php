<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/manage-users', [ManageUsersController::class, 'loadManageUsers'])->name('admin.manage-users');
    Route::delete('/users/{id}', [ManageUsersController::class, 'deleteUser'])->name('admin.users.delete');
    Route::put('/users/{id}', [ManageUsersController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/users', [ManageUsersController::class, 'addUser'])->name('admin.users.add');
    
    Route::get('/manage-tryouts', [TryoutController::class, 'loadManageTryouts'])->name('admin.tryouts.index');
    Route::post('/tryouts', [TryoutController::class, 'addTryout'])->name('admin.tryouts.store');
    Route::put('/tryouts/{id}', [TryoutController::class, 'updateTryout'])->name('admin.tryouts.update');
    Route::delete('/tryouts/{id}', [TryoutController::class, 'deleteTryout'])->name('admin.tryouts.delete');
    
    Route::get('/categories', [CategoriesController::class, 'loadManageCategories'])->name('admin.categories.index');
    Route::post('/categories', [CategoriesController::class, 'addCategory'])->name('admin.categories.store');
    Route::put('/categories/{id}', [CategoriesController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoriesController::class, 'deleteCategory'])->name('admin.categories.delete');
    
    Route::get('/manage-questions', [QuestionsController::class, 'loadManageQuestions'])->name('admin.questions.index');
    Route::post('/questions', [QuestionsController::class, 'store'])->name('admin.questions.store');
    Route::put('/questions/{id}', [QuestionsController::class, 'update'])->name('admin.questions.update');
    Route::delete('/questions/{id}', [QuestionsController::class, 'deleteQuestion'])->name('admin.questions.delete');
    
    Route::get('/announcements', [AnnouncementController::class, 'loadAnnouncements'])->name('admin.announcements');
    Route::post('/announcements', [AnnouncementController::class, 'addAnnouncement'])->name('admin.announcements.store');
    Route::put('/announcements/{id}', [AnnouncementController::class, 'updateAnnouncement'])->name('admin.announcements.update');
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'deleteAnnouncement'])->name('admin.announcements.delete');
    Route::put('/announcements/{id}/toggle', [AnnouncementController::class, 'toggleAnnouncement'])->name('admin.announcements.toggle');
});

Route::prefix('u')->group(function () {
    Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});