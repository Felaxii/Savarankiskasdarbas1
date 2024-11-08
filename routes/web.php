<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConferenceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Models\Conference;
use Illuminate\Support\Facades\Auth;

// Main page route
Route::get('/', function () {
    return view('welcome'); // Main system page
});

// Client routes
Route::prefix('client')->group(function () {
    // Display all conferences
    Route::get('/conferences', [ClientController::class, 'index'])->name('client.conferences.index');
    
    // Display a specific conference
    Route::get('/conferences/{id}', [ClientController::class, 'show'])->name('client.conferences.show');

    // Routes for conference-specific registration
    Route::get('/conferences/register/{conferenceId}', [ClientController::class, 'showConferenceRegisterForm'])->name('client.conferences.register');
    Route::post('/conferences/register/{conferenceId}', [ClientController::class, 'conferenceRegister'])->name('client.conferences.register.post');

    // Client Login route
    Route::get('/login', [ClientController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.post');
});

// Employee routes
Route::prefix('employee')->middleware(['auth', 'role:employee'])->group(function () {
    // Display all conferences
    Route::get('/conferences', [EmployeeController::class, 'index'])->name('employee.conferences.index');
    
    // Show attendees for a specific conference
    Route::get('/conference/{conference}/attendees', [ConferenceController::class, 'showAttendees'])->name('conference.attendees');
    Route::get('/conferences/{conferenceId}/attendees', [EmployeeController::class, 'showAttendees'])->name('employee.conferences.attendees');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Conference management routes
    Route::get('/conferences', [ConferenceController::class, 'index'])->name('admin.conferences.index');
    Route::get('/conferences/create', [ConferenceController::class, 'create'])->name('admin.conferences.create');
    Route::post('/conferences', [ConferenceController::class, 'store'])->name('admin.conferences.store');
    Route::get('/conferences/{id}/edit', [ConferenceController::class, 'edit'])->name('admin.conferences.edit');
    Route::put('/conferences/{id}', [ConferenceController::class, 'update'])->name('admin.conferences.update');
    Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy'])->name('admin.conferences.destroy');

    // Admin Dashboard (direct route to view)
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard content
    })->name('admin.dashboard');

    // User management routes
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // Edit user route
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Employee login
Route::get('/employee/login', [AuthController::class, 'showLoginForm'])->name('employee.login');
Route::post('/employee/login', [AuthController::class, 'login'])->name('employee.login.submit');

// Admin login
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Logout route for all users
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// Access Denied Route
Route::get('/access-denied', function () {
    return view('access_denied');
})->name('access.denied');


Route::prefix('client')->group(function () {
    // Display all conferences
    Route::get('/conferences', [ClientController::class, 'index'])->name('client.conferences.index');
    
    // Display a specific conference
    Route::get('/conferences/{id}', [ClientController::class, 'show'])->name('client.conferences.show');

    // Routes for conference-specific registration
    Route::get('/conferences/register/{conferenceId}', [ClientController::class, 'showConferenceRegisterForm'])->name('client.conferences.register');
    Route::post('/conferences/register/{conferenceId}', [ClientController::class, 'conferenceRegister'])->name('client.conferences.register.post');

    // Client Login route
    Route::get('/login', [ClientController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.post');
});
