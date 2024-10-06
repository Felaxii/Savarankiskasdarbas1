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
    Route::get('/conferences', [ClientController::class, 'index'])->name('client.conferences.index'); // Display all conferences
    Route::get('/conferences/{id}', [ClientController::class, 'show'])->name('client.conferences.show'); // Display a specific conference
    Route::get('/register', [ClientController::class, 'create'])->name('client.register'); // Registration route
    Route::post('/register', [ClientController::class, 'register'])->name('client.register.post'); // Handle registration form submission
});
// Employee routes
Route::prefix('employee')->group(function () {
    Route::get('/conferences', [EmployeeController::class, 'index'])->name('employee.conferences.index'); // Display all conferences
    Route::get('/conferences/{id}', [EmployeeController::class, 'show'])->name('employee.conferences.show'); // Display a specific conference
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/conferences', [ConferenceController::class, 'index'])->name('admin.conferences.index'); // List all conferences
    Route::get('/conferences/create', [ConferenceController::class, 'create'])->name('admin.conferences.create'); // Create conference form
    Route::post('/conferences', [ConferenceController::class, 'store'])->name('admin.conferences.store'); // Store new conference
    Route::get('/conferences/{id}/edit', [ConferenceController::class, 'edit'])->name('admin.conferences.edit');
    Route::put('/conferences/{id}', [ConferenceController::class, 'update'])->name('admin.conferences.update');
    Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy'])->name('admin.conferences.destroy');
});
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('home'); // Admin Dashboard view
    })->name('admin.dashboard');
    

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index'); // List all users
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // Edit user form
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update'); // Update user

    // Conference Management



