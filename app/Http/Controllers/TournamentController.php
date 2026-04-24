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
    // 1. Update validation to match the NEW input names
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'format' => 'required|in:Singles,Doubles,Mixed Doubles',
        'description' => 'nullable|string',
    ]);

    // 2. Create the tournament using the validated data
    \App\Models\Tournament::create([
        'name' => $validated['name'],
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],
        'format' => $validated['format'],
        'description' => $validated['description'],
    ]);

    // 3. Redirect back to the admin dashboard
    return redirect()->route('admin.dashboard')->with('success', 'Tournament published successfully!');
}
}
