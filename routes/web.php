<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SubscriptionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->post('/users/{id}/role', [UserRoleController::class, 'updateRole']);

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::middleware(['auth', 'role:Author'])->group(function () {
    Route::get('/author', function () {
        return 'Welcome, Author!';
    });
});

Route::middleware(['auth', 'role:Reader'])->group(function () {
    Route::get('/reader', function () {
        return 'Welcome, Reader!';
    });
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/create', [AdminDashboardController::class, 'create'])->name('create');
    Route::post('/store', [AdminDashboardController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [AdminDashboardController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [AdminDashboardController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [AdminDashboardController::class, 'destroy'])->name('destroy');

     // Article management
     Route::get('/create-article', [AdminDashboardController::class, 'createArticle'])->name('create-article');
     Route::post('/store-article', [AdminDashboardController::class, 'storeArticle'])->name('store-article');
     Route::get('/edit-article/{article}', [AdminDashboardController::class, 'editArticle'])->name('edit-article');
     Route::put('/update-article/{article}', [AdminDashboardController::class, 'updateArticle'])->name('update-article');
     Route::delete('/delete-article/{article}', [AdminDashboardController::class, 'destroyArticle'])->name('delete-article');
});

Route::resource('articles', ArticleController::class)->middleware('auth');

Route::middleware(['auth', 'role:Author'])->prefix('author')->name('author.')->group(function () {
    Route::get('/dashboard', [ArticleController::class, 'authorDashboard'])->name('dashboard');
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
});

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware(['auth', 'role:Reader'])->prefix('subscriptions')->name('subscriptions.')->group(function () {
    Route::get('/', [SubscriptionController::class, 'index'])->name('index');
    Route::get('/select-dates', [SubscriptionController::class, 'selectDates'])->name('select-dates');
    Route::post('/create', [SubscriptionController::class, 'create'])->name('create');
    Route::post('/store', [SubscriptionController::class, 'store'])->name('store');
    Route::post('/summary', [SubscriptionController::class, 'summary'])->name('summary');
    Route::get('/thank-you', [SubscriptionController::class, 'thankYou'])->name('thank-you');
});


Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/subscriptions/{subscription}/approve', [AdminDashboardController::class, 'approveSubscription'])->name('subscriptions.approve');
    Route::post('/subscriptions/{subscription}/reject', [AdminDashboardController::class, 'rejectSubscription'])->name('subscriptions.reject');
});
