<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Front\ArchiveController;
use App\Http\Controllers\Front\CategoryController;



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard - Tüm admin kullanıcılar erişebilir
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Blog List - Editor ve üstü erişebilir
    Route::get('/blogList', [BlogController::class, 'index'])->name('blog.index')->middleware('role:Editor');
    
    // Profile - Tüm admin kullanıcılar erişebilir
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    
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

