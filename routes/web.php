<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryController;



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/blogList', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');




    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');

