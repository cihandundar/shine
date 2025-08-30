<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Front\ArchiveController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
Route::get('/category', [FrontCategoryController::class, 'index'])->name('category.index');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard - Tüm admin kullanıcılar erişebilir
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Blog Management - Editor ve üstü erişebilir
    Route::middleware('role:Editor')->group(function () {
        Route::get('/blogList', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::patch('/blog/{id}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blog.toggleStatus');
    });

    // Category Management - Editor ve üstü erişebilir
    Route::middleware('role:Editor')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Author Management - Editor ve üstü erişebilir
    Route::middleware('role:Editor')->group(function () {
        Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
        Route::post('/authors', [AuthorController::class, 'store'])->name('author.store');
        Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('author.update');
        Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
    });
    
    // Profile - Tüm admin kullanıcılar erişebilir
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Admin User Management - Sadece Super Admin erişebilir
    Route::middleware('role:Super Admin')->group(function () {
        Route::get('/adminList', [AdminController::class, 'index'])->name('adminList');
        Route::post('/adminList', [AdminController::class, 'store'])->name('adminList.store');
        Route::put('/adminList/{id}', [AdminController::class, 'update'])->name('adminList.update');
        Route::delete('/adminList/{id}', [AdminController::class, 'destroy'])->name('adminList.destroy');
        Route::post('/adminList/{id}/assign-role', [AdminController::class, 'assignRole'])->name('adminList.assignRole');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');

