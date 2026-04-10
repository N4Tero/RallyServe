<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Models\Tournament;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    // Fetch the 4 newest tournaments from the database
    $tournaments = Tournament::latest()->take(4)->get();
    
    // Pass them to the welcome view
    return view('home', ['tournaments' => $tournaments]);   


});

Route::get('/login', function () {
  
    return view('auth.login'); 
})->name('login');


Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

// Show the Forgot Password Page
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Handle the form submission
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');



// When the form is submitted, send the data to the Controller
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


    // 1. The route Laravel uses to build the email link (and show the final form)
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// 2. The route that handles the final form submission to change the password
Route::post('/reset-password', [App\Http\Controllers\AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

    // Show the Reset Password Page (Notice how it catches the {token} from the URL)
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// Handle the form submission
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');


// --- THE SECRET STAFF PORTAL ---
Route::get('/rally-manage-portal', function () {
    return view('auth.admin-login');
})->middleware('guest');
// Make sure this exists somewhere in your web.php!
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware('auth')->group(function () {
    
    // The Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // The Booking Routes
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store']);
    
});

// --- NORMAL USER ROUTES ---
// The 'auth' middleware ensures only logged-in users can access this group
Route::middleware('auth')->prefix('dashboard')->group(function () {
    
   
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');

});

Route::get('/find-courts', function () {
    
    return view('find-courts', ['courts' => []]);
})->name('courts.index');

Route::middleware('auth')->group(function () {
    // ... your other dashboard routes ...
    
    Route::post('/bookings', [BookingController::class, 'store']);
});