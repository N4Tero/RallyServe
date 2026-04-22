<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Models\Tournament;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ==========================================
// 1. PUBLIC ROUTES (No login required)
// ==========================================
Route::get('/', function () {
    $tournaments = Tournament::latest()->take(4)->get();
    return view('home', ['tournaments' => $tournaments]);   
});

Route::get('/find-courts', function () {
    return view('find-courts', ['courts' => []]);
})->name('courts.index');


// ==========================================
// 2. AUTHENTICATION ROUTES (Guests Only)
// ==========================================
Route::middleware('guest')->group(function () {
    
    // Login & Register
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password Reset
    Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    
    Route::get('/reset-password/{token}', function (string $token) { return view('auth.reset-password', ['token' => $token]); })->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // Secret Staff Portal
    Route::get('/rally-manage-portal', function () { return view('auth.admin-login'); });
});

// Logout (Must be logged in to log out)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// ==========================================
// 3. NORMAL USER ROUTES (Requires Login)
// ==========================================
Route::middleware('auth','verified')->group(function () {
    
    // User Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // Booking Pipeline
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store']);
    
});


// ==========================================
// 4. ADMIN & STAFF ROUTES (Requires Admin Role)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Admin Dashboard (URL: /admin/dashboard)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Tournament Management (URL: /admin/tournaments/create)
    Route::get('/tournaments/create', [TournamentController::class, 'create'])->name('tournaments.create');
    Route::post('/tournaments', [TournamentController::class, 'store'])->name('tournaments.store');
    
});

// 1. The page telling the user to "Check your email"
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // We will need to make this simple HTML page next
})->middleware('auth')->name('verification.notice');

// 2. The actual link inside the email that the user clicks (This fixes your error!)
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/'); // Sends them to the homepage after successfully verifying
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. The route that handles the "Resend Verification Email" button
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');