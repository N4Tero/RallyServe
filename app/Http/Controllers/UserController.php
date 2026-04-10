<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
       $user = auth()->user();

        // Fetch their specific bookings, ordering them by the upcoming dates first
        $bookings = $user->bookings()->orderBy('booking_date', 'asc')->get();

        // Pass the bookings to the dashboard view
        return view('dashboard', ['bookings' => $bookings]);
    }
}
