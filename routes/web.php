<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConferenceController;
use App\Http\Controllers\EmployeeController;

// Main page route
Route::get('/', function () {
    return view('welcome');
});

// Client routes
Route::prefix('client')->group(function () {
    Route::get('/conferences', [EmployeeController::class, 'index'])->name('client.conferences.index'); // Display all conferences
    Route::get('/conferences/{id}', [EmployeeController::class, 'show'])->name('client.conferences.show'); // Display a specific conference
    Route::post('/register', function () {
        return redirect()->back(); // Simple registration logic that refreshes the page
    })->name('client.register'); // Registration route
});

// Employee routes
Route::prefix('employee')->group(function () {
    Route::get('/conferences', [EmployeeController::class, 'index'])->name('employee.conferences.index'); // Display all conferences
    Route::get('/conferences/{id}', [EmployeeController::class, 'show'])->name('employee.conferences.show'); // Display a specific conference
});

// Admin routes
Route::prefix('admin')->group(function () {
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index'); // List all users
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // Edit user form
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update'); // Update user

    // Conference Management
    Route::get('/conferences', [ConferenceController::class, 'index'])->name('admin.conferences.index'); // List all conferences
    Route::get('/conferences/create', [ConferenceController::class, 'create'])->name('admin.conferences.create'); // Create conference form
    Route::post('/conferences', [ConferenceController::class, 'store'])->name('admin.conferences.store'); // Store new conference
    Route::get('/conferences/{id}/edit', [ConferenceController::class, 'edit'])->name('admin.conferences.edit'); // Edit conference form
    Route::put('/conferences/{id}', [ConferenceController::class, 'update'])->name('admin.conferences.update'); // Update conference
    Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy'])->name('admin.conferences.destroy'); // Delete conference
});
