<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

// Welcome Route (only accessible by guests)
Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('guest');

// Client routes
// Client routes
Route::prefix('client')->group(function () {
    Route::get('/conferences', [ClientController::class, 'index'])->name('client.conferences.index');
    Route::get('/conferences/{id}', [ClientController::class, 'show'])->name('client.conferences.show');
    Route::get('/conferences/register/{conferenceId}', [ClientController::class, 'showConferenceRegisterForm'])->name('client.conferences.register');
    Route::post('/conferences/register/{conferenceId}', [ClientController::class, 'conferenceRegister'])->name('client.conferences.register.post');
    Route::get('/login', [ClientController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.post');
    Route::post('/continue-as-client', [ClientController::class, 'continueAsClient'])->name('client.continueAsClient');

    // Redirect logged-in clients directly to their dashboard
    Route::get('/', [ClientController::class, 'index'])->name('client.dashboard')->middleware('auth');
});

// Employee routes with middleware for role-based access
Route::prefix('employee')->group(function () {
    Route::get('/login', [AuthController::class, 'displayLogin'])->name('employee.login')->middleware('guest'); 
    Route::post('/login', [AuthController::class, 'loginEmployee'])->name('employee.login.submit');
    
    Route::middleware('role:employee')->group(function () {
        Route::get('/conferences', [EmployeeController::class, 'index'])->name('employee.conferences.index');
        Route::get('/conferences/{conferenceId}/attendees', [EmployeeController::class, 'showAttendees'])->name('employee.conferences.attendees');
    });
});

// Admin routes with middleware for role-based access
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'displayLogin'])->name('admin.login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');

    // Protected by role middleware, accessible to admins only
    Route::middleware('role:admin')->group(function () {
        // Admin home page (points to home.blade.php)
        Route::get('/home', function () {
            return view('home'); // Admin's main page (home.blade.php)
        })->name('admin.home');

        // Admin conference routes
        Route::get('/conferences', [AdminController::class, 'listConferences'])->name('admin.conferences.index');
        
        // Admin user management routes
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    });
});

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Access Denied Route
Route::get('/access-denied', function () {
    return view('access_denied');
})->name('access.denied');