<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ManageCategoryController;
use App\Http\Controllers\ManageLocationController;
use App\Http\Controllers\ManageMenuController;
use App\Http\Controllers\ManageOrderController;
use App\Http\Controllers\ManageReviewController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landing'])->name('landing');
Route::get('/feature', [HomeController::class, 'feature'])->name('featurePage');
Route::get('/works', [HomeController::class, 'howItWorks'])->name('HowItWorksPage');
Route::get('/login', [LoginController::class, 'show'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'show'])->name('registerPage');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    Route::get('/manage', [HomeController::class, 'manage'])->name('admin.manage');
    Route::resource('users', ManageUserController::class);
    Route::resource('menus', ManageMenuController::class);
    Route::resource('categories', ManageCategoryController::class);
    Route::resource('locations', ManageLocationController::class);
    Route::resource('orders', ManageOrderController::class);
    Route::resource('reviews', ManageReviewController::class);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'managePassword'])->name('profile.password.manage');
    Route::post('/profile/photo', [ProfileController::class, 'managePhoto'])->name('profile.photo.manage');
    Route::get('/switch/{mode}', [ProfileController::class, 'switch'])->name('user.switch.mode');
});

Route::prefix('titiper')->middleware(['auth', 'role:user', 'mode:titiper'])->group(function () {
    Route::get('/', [HomeController::class, 'titiperHome'])->name('titiper.home');

    Route::get('/menu', [MenuController::class, 'index'])->name('titiper.menu.index');
    Route::get('/menu/{menuId}', [MenuController::class, 'show'])->name('titiper.menu.show');
    Route::post('/menu/{menuId}/orders', [MenuController::class, 'createOrderFromMenu'])->name('titiper.menu.createOrder');

    Route::get('/orders', [OrderController::class, 'index'])->name('titiper.orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('titiper.orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('titiper.orders.store');

    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('titiper.orders.show');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('titiper.orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('titiper.orders.update');

    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('titiper.orders.destroy');

    Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->name('titiper.order.complete');

    Route::get('/reviews/create/{orderId}', [ReviewController::class, 'create'])->name('titiper.reviews.create');
    Route::post('/reviews/{orderId}', [ReviewController::class, 'store'])->name('titiper.reviews.store');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('titiper.reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('titiper.reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('titiper.reviews.destroy');

    Route::get('/profile', [ProfileController::class, 'showTitiper'])->name('titiper.profile');
});

Route::prefix('runner')->middleware(['auth', 'role:user', 'mode:runner'])->group(function () {
    Route::get('/', [HomeController::class, 'runnerhome'])->name('runner.home');

    Route::get('/orders', [OrderController::class, 'runnerIndex'])->name('runner.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'runnerShow'])->name('runner.orders.show');

    Route::get('/orders/{id}/accept', [OrderController::class, 'accepted'])->name('runner.orders.accept');
    Route::get('/orders/{id}/pickup', [OrderController::class, 'pickup'])->name('runner.orders.pickup');
    Route::get('/orders/{id}/deliver', [OrderController::class, 'deliver'])->name('runner.orders.deliver');
    Route::get('/orders/{id}/complete', [OrderController::class, 'complete'])->name('runner.orders.complete');

    Route::get('/history', [HistoryController::class,'historyIndex'])->name('runner.history.index');
    Route::get('/history/{id}', [HistoryController::class, 'historyShow'])->name('runner.history.show');

    Route::get('/profile', [ProfileController::class, 'showRunner'])->name('runner.profile');
});
