<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
class AdminController extends Controller
{
   public function dashboard()
{
    // Fetch bookings with their related user, court, and facility data
    $bookings = \App\Models\Booking::with(['user', 'court.facility'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    return view('admin.dashboard', compact('bookings'));
}

// Add this new function to handle the status changes
public function updateStatus(Request $request, \App\Models\Booking $booking)
{
    $request->validate([
        'status' => 'required|in:Approved,Cancelled,Pending'
    ]);

    $booking->update(['status' => $request->status]);

    return back()->with('success', "Booking {$booking->reference_number} has been {$request->status}.");
}
    // --- 1. Show the Form ---
    public function create()
    {
        // We will create this view file in a moment
        return view('admin.tournaments.create');
    }

    // --- 2. Save the Data to the Database ---
    public function store(Request $request)
    {
        // 1. Validate the incoming data so no bad data gets into the database
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'format' => 'required|string|max:255',
            'status' => 'required|string',
            'prize_details' => 'required|string|max:255',
            'registration_link' => 'nullable|url' // Optional, but must be a valid URL if provided
        ]);

        // 2. Create the tournament in the database using the validated data
        Tournament::create($validatedData);

        // 3. Send the staff member back to the dashboard with a success message!
        return redirect('/admin/dashboard')->with('status', 'Tournament created successfully!');
    }
}
