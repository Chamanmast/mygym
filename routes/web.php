<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClassTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
use App\Http\Controllers\UserController;
use App\Models\ClassType;
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

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');
Route::get('admin/users', [UserController::class, 'all'])->middleware(['auth', 'role:admin'])->name('admin.users');


Route::get('instructor/dashboard', function () {
    return view('instructor.dashboard');
})->middleware(['auth', 'role:instructor'])->name('instructor.dashboard');


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('member/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');
    Route::resource('member/bookings', BookingController::class)->only(['index', 'create', 'store', 'destroy']);
});

Route::resource('instructor/schedule', ScheduledClassController::class)->middleware(['auth', 'role:admin|instructor']);

Route::resource('class_type', ClassTypeController::class)->middleware(['auth', 'role:admin|instructor']);


Route::get('member/dashboard', function () {
    return view('member.dashboard');
})->middleware(['auth', 'role:user'])->name('member.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
