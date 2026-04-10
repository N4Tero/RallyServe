<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // --- 1. Handle Sign Up (Registration) ---
    public function register(Request $request)
    {
        // Validate the incoming form data
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'] 
        ]);

        // Securely hash the password before saving to database
        $incomingFields['password'] = Hash::make($incomingFields['password']); 
        $user = User::create($incomingFields);// Create the user in the database
        Auth::login($user); // Create the user in the database

        return redirect('/');
    }

    // --- 2. Handle Log In ---
    public function login(Request $request)
    {
        // Validate the incoming form data
       $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($incomingFields)) {
            $request->session()->regenerate();
            
            // --- NEW: The Traffic Cop Logic ---
            $role = auth()->user()->role;
            
            if ($role === 'admin' || $role === 'staff') {
                return redirect('/admin/dashboard'); // Send staff here
            }

            return redirect('/dashboard'); // Send normal users here
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // --- 3. Handle Log Out ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    // --- 4. Handle Sending the Reset Link ---
    public function sendResetLink(Request $request)
    {
        // 1. Validate the email
        $request->validate(['email' => 'required|email']);

        // 2. Tell Laravel to find the user and send the email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // 3. Return a success message or an error message
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // --- 5. Handle the Actual Password Reset ---
    public function resetPassword(Request $request)
    {
        // 1. Validate the form data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // 2. Attempt to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // If the token is valid, update the user's password securely
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        // 3. Check if it worked
        if ($status == Password::PASSWORD_RESET) {
            // Success! Send them to login with a success message.
            return redirect('/login')->with('status', 'Your password has been reset! Please log in.');
        }

        // Failure! Token might be expired.
        return back()->withErrors(['email' => __($status)]);
    }
}