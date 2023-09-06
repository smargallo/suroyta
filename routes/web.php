<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'index']);

    Route::get('/establishments/create', [App\Http\Controllers\EstablishmentController::class, 'create']);
    Route::post('/establishments', [App\Http\Controllers\EstablishmentController::class, 'store']);
    
    Route::resource('destinations', App\Http\Controllers\DestinationController::class);
    Route::resource('establishments', App\Http\Controllers\EstablishmentController::class);

    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [App\Http\Controllers\AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/update', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('profile.password');
    Route::put('/users/{id}/update-status', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('update-status'); 

    Route::get('/fetch-users', [App\Http\Controllers\AdminController::class, 'fetchUsers'])->name('fetch-user');

});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/update', [App\Http\Controllers\UserController::class, 'changePassword'])->name('profile.password');
});
