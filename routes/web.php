<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [RegisterController::class, 'register'])->name('register');
Route::get('/register/time', [RegisterController::class, 'registerTime'])->name('register.time');
Route::post('/register/time', [RegisterController::class, 'saveTime'])->name('save.time');
Route::post('/register/user', [RegisterController::class, 'store'])->name('register.user');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/ranking', [DashboardController::class, 'ranking'])->middleware(['auth', 'verified'])->name('ranking');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/enrollment/export', [DashboardController::class, 'enrollmentExport'])->name('enrollment.export');
Route::post('/ranking/export', [DashboardController::class, 'rankingExport'])->name('ranking.export');

Route::get('/clear', function() {
    Artisan::call('optimize:clear');
    return redirect()->back();
});

require __DIR__.'/auth.php';
