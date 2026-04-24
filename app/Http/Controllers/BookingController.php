<?php

namespace App\Http\Controllers;
use App\Models\Court;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // 1. Show the booking form and the courts
    public function create()
    {
        // Only fetch active courts (prevents booking a court under maintenance)
        $courts = Court::where('status', 'Active')->get();
        
        return view('bookings.create', compact('courts'));
    }

    // 2. The Bulletproof Store Method
    public function store(Request $request)
    {
        // 1. Validate the incoming data so they can't book the past or end before they start
        $validated = $request->validate([
            'court_id' => 'required|exists:courts,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        try {
            // Ensure seconds are stripped or added to match DB format if needed
            $validated['start_time'] = date('H:i:s', strtotime($validated['start_time']));
            $validated['end_time'] = date('H:i:s', strtotime($validated['end_time']));
            
            // 2. Wrap in a Database Transaction to prevent exact-millisecond double bookings
            // Notice we only need to pass $validated now, not $request
            DB::transaction(function () use ($validated) {

                // 3. The Overlap Check (The heart of your defense)
                // Using $validated guarantees the H:i:s format matches the database exactly
                $conflict = Booking::where('court_id', $validated['court_id'])
                    ->where('booking_date', $validated['booking_date'])
                    ->whereIn('status', ['Pending', 'Approved'])
                    ->where(function ($query) use ($validated) {
                        $query->where('start_time', '<', $validated['end_time'])
                              ->where('end_time', '>', $validated['start_time']);
                    })
                    ->lockForUpdate() // Locks the rows being checked so no one else can read them until we finish
                    ->exists();

                if ($conflict) {
                    // MUST use 'throw new Exception' here. Returning a redirect inside a transaction fails silently!
                    throw new \Exception('This time slot overlaps with an existing reservation. Please choose a different time.');
                }

                // 4. If no conflict, create the booking!
                Booking::create([
                    'reference_number' => 'RS-' . strtoupper(uniqid()), // Generates RS-A1B2C3D4
                    'user_id' => Auth::id(),
                    'court_id' => $validated['court_id'],
                    'booking_date' => $validated['booking_date'],
                    'start_time' => $validated['start_time'],
                    'end_time' => $validated['end_time'],
                    'status' => 'Pending', // Force it to Pending so staff can approve
                ]);
                
            });

            // This only triggers if the transaction above finishes completely without hitting the Exception
            return redirect('/dashboard')->with('success', 'Booking requested successfully! Please wait for approval.');

        } catch (\Exception $e) {
            // If the transaction threw an Exception (the overlap check failed), they land here
            return back()->withInput()->withErrors(['overlap' => $e->getMessage()]);
        }
    }
    public function checkAvailability(Request $request)
    {
        $courtId = $request->query('court_id');
        $date = $request->query('date');

        // If data is missing, return an empty list
        if (!$courtId || !$date) {
            return response()->json([]);
        }

        // Fetch all taken slots for that court and date
        // We only care about Pending or Approved bookings
        $bookedSlots = Booking::where('court_id', $courtId)
            ->where('booking_date', $date)
            ->whereIn('status', ['Pending', 'Approved'])
            ->orderBy('start_time', 'asc')
            ->get(['start_time', 'end_time']);

        // Send the data back to the frontend in JSON format
        return response()->json($bookedSlots);
    }
}