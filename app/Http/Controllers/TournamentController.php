<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class TournamentController extends Controller
{
    // 1. Show the form to create a tournament
    public function create()
    {
        return view('tournaments.create'); 
    }

    // 2. Save the tournament to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date_range' => 'required|string|max:255', // e.g., "March 26-27 2026"
            'format' => 'required|string|max:255',     // e.g., "Singles & Mix Doubles"
            'status' => 'required|string|max:50',      // e.g., "Soon", "Registration Open"
            'prize_details' => 'required|string|max:255', // e.g., "PHP 10,000"
            'registration_link' => 'nullable|url',     // Optional URL
        ]);

        // Create the tournament
        Tournament::create($validated);

        return redirect('/admin/dashboard')->with('success', 'Tournament created successfully!');
    }
}
