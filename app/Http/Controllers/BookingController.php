<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
class BookingController extends Controller
{
    public function create(Request $request)
    {
        // Catch the court name from the URL if they clicked "Book Now"
        $courtName = $request->query('court');
        
        return view('bookings.create', ['courtName' => $courtName]);
    }

    public function store(Request $request)
    {
        // 1. Validate the input
        $validated = $request->validate([
            'court_name' => 'required|string',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // 2. Create the booking linked to the current user
        $request->user()->bookings()->create($validated);

        // 3. Redirect to dashboard with a success message
        return redirect('/dashboard')->with('success', 'Court booked successfully!');
    }

    
}
