<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\MenuController;

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
    return view('index');
});



Route::get('menuList', [MenuController::class, 'index'])->name('menus.index');
Route::get('create', [MenuController::class, 'create'])->name('menus.create');
Route::post('store', [MenuController::class, 'store'])->name('store');
Route::get('menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
Route::get('menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::put('menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
Route::delete('menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);



Route::get('/profile/{user}', [UserProfileController::class, 'show'])->name('user.profile');
Route::put('/profile/{user}', [UserProfileController::class, 'update'])->name('user.update');


Route::middleware(['auth'])->group(function () {
    Route::get('/operator/dashboard', [OperatorController::class, 'index'])->name('operator.dashboard');

    Route::post('/operator/restaurant', [OperatorController::class, 'storeRestaurant'])->name('operator.restaurant.store');
    Route::delete('/operator/restaurant/{id}', [OperatorController::class, 'destroyRestaurant'])->name('operator.restaurant.destroy');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    // Route::get('/search', [clientController::class, 'showSearchForm'])->name('client.search');
});
  
require __DIR__.'/auth.php';
    

