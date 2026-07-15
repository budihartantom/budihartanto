<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Models\Course;
use App\Models\Portfolio;
use App\Models\WebService;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    $portfolios = Portfolio::orderBy('order_index')->get();
    $courses = Course::withCount('lessons')->get();
    $services = WebService::all();
    return view('welcome', compact('portfolios', 'courses', 'services'));
})->name('home');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Dashboard & Management Routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');
    });

    // Student Dashboard & LMS Routes
    Route::middleware('role:student')->prefix('student')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        Route::get('/courses/{course}', [StudentController::class, 'showCourse'])->name('student.courses.show');
    });

    // Client Dashboard & Project Tracker Routes
    Route::middleware('role:client')->prefix('client')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    });
});
