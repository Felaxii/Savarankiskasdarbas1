<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

// Welcome Route (only accessible by guests)
Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('guest');

// Access Denied Route
Route::get('/access-denied', function () {
    return view('access_denied');
})->name('access.denied');

// Logout route (clears session for all roles)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Client Routes
Route::prefix('client')->group(function () {
    Route::get('/conferences', [ClientController::class, 'index'])->name('client.conferences.index');
    Route::get('/conferences/{id}', [ClientController::class, 'show'])->name('client.conferences.show');
    Route::get('/conferences/register/{conferenceId}', [ClientController::class, 'showConferenceRegisterForm'])->name('client.conferences.register');
    Route::post('/conferences/register/{conferenceId}', [ClientController::class, 'conferenceRegister'])->name('client.conferences.register.post');

    // Client Login and Role Assignment Routes
    Route::get('/login', [ClientController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.post');
    Route::post('/continue-as-client', [ClientController::class, 'continueAsClient'])->name('client.continueAsClient');

    // Redirect logged-in clients directly to the latest conference
    Route::get('/redirect-to-latest-conference', [ClientController::class, 'redirectToLatestConference'])
        ->name('client.redirectToLatestConference')
        ->middleware('auth');
});

// Employee Routes (Accessible by both employee and admin roles)
Route::prefix('employee')->group(function () {
    Route::get('/login', [AuthController::class, 'displayLogin'])->name('employee.login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'loginEmployee'])->name('employee.login.submit');

    Route::middleware(['auth', 'role:employee|admin'])->group(function () {
        Route::get('/conferences', [EmployeeController::class, 'index'])->name('employee.conferences.index');
        Route::get('/conferences/{conferenceId}/attendees', [EmployeeController::class, 'showAttendees'])->name('employee.conferences.attendees');
        Route::get('/conferences/{id}', [EmployeeController::class, 'show'])->name('employee.conferences.show');
    });
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'displayLogin'])->name('admin.login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/home', function () {
            return view('home');
        })->name('admin.home');

        Route::get('/conferences', [AdminController::class, 'listConferences'])->name('admin.conferences.index');
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
        
       // User Edit
         Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
         Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
         Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
         Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');

        // Conference Edit
        Route::get('/conferences', [AdminController::class, 'listConferences'])->name('admin.conferences.index'); 
        Route::get('/conferences/create', [AdminController::class, 'createConference'])->name('admin.conferences.create'); 
        Route::post('/conferences', [AdminController::class, 'storeConference'])->name('admin.conferences.store'); 
        Route::get('/conferences/{conference}/edit', [AdminController::class, 'editConference'])->name('admin.conferences.edit'); 
        Route::put('/conferences/{conference}', [AdminController::class, 'updateConference'])->name('admin.conferences.update'); 
        Route::delete('/conferences/{conference}', [AdminController::class, 'deleteConference'])->name('admin.conferences.destroy'); 

    });
});
