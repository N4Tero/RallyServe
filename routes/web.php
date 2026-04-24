<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Models\Tournament;
use App\Models\Court; // Added so the find-courts route knows what a Court is
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

// UPGRADED: Includes Search and Pagination logic!
Route::get('/find-courts', function (Request $request) {
    $searchTerm = $request->query('query');

    $courts = Court::where('status', 'Active')
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->whereHas('facility', function($q) use ($searchTerm) {
                $q->where('facility_name', 'like', '%' . $searchTerm . '%');
            })->orWhere('court_name', 'like', '%' . $searchTerm . '%');
        })
        ->paginate(6);
    
    return view('find-courts', compact('courts', 'searchTerm'));
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
Route::middleware(['auth', 'verified'])->group(function () {
    
    // User Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // Booking Pipeline
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('book.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('book.store');
    
    // THE MISSING AJAX ROUTE: Checks if a timeslot is taken in real-time
    Route::get('/api/availability', [BookingController::class, 'checkAvailability'])->name('api.availability');
    
});


// ==========================================
// 4. ADMIN & STAFF ROUTES (Requires Admin Role)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Admin Dashboard (URL: /admin/dashboard)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::patch('/bookings/{booking}/status', [AdminController::class, 'updateStatus'])->name('admin.bookings.status');
    // Tournament Management (URL: /admin/tournaments/create)
    Route::get('/tournaments/create', [TournamentController::class, 'create'])->name('tournaments.create');
    Route::post('/tournaments', [TournamentController::class, 'store'])->name('tournaments.store');
    
});

// ==========================================
// 5. EMAIL VERIFICATION ROUTES
// ==========================================
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/'); 
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/api/availability', [BookingController::class, 'checkAvailability'])->name('api.availability');