<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConferenceController;
use App\Http\Controllers\EmployeeController;

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

    // Login route
    Route::get('/login', [ClientController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.post');
});

// Employee routes
Route::prefix('employee')->group(function () {
    // Display all conferences
    Route::get('/conferences', [EmployeeController::class, 'index'])->name('employee.conferences.index');
    
    // Display a specific conference (you may use this for viewing conference details)
    Route::get('/conferences/{id}', [EmployeeController::class, 'show'])->name('employee.conferences.show');
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Conference management routes
    Route::get('/conferences', [ConferenceController::class, 'index'])->name('admin.conferences.index');
    Route::get('/conferences/create', [ConferenceController::class, 'create'])->name('admin.conferences.create');
    Route::post('/conferences', [ConferenceController::class, 'store'])->name('admin.conferences.store');
    Route::get('/conferences/{id}/edit', [ConferenceController::class, 'edit'])->name('admin.conferences.edit');
    Route::put('/conferences/{id}', [ConferenceController::class, 'update'])->name('admin.conferences.update');
    Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy'])->name('admin.conferences.destroy');

    // Admin Dashboard (not client or employee routes)
    Route::get('/dashboard', function () {
        return view('home'); // Admin Dashboard view
    })->name('admin.dashboard');

    // User management routes
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
