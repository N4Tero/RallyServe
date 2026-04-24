<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create your Admin/Test User
    \App\Models\User::create([
        'name' => 'Test Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]);
    \App\Models\User::create([
        'name' => 'Test User',
        'email' => 'user@gmail.com',
        'password' => bcrypt('password1234'),
        'role' => 'user',
        'email_verified_at' => now(),
    ]);

    // Create the Facility
    $facility = \App\Models\Facility::create([
        'facility_name' => 'JG Oranza Sports Center Arena',
        'address' => 'Buayan, General Santos',
        'contact_number' => '09123456789',
        'facility_image' => 'facilities/jg-oranza.jpg'
    ]);

    // Create the Courts
    $facility->courts()->create([
        'court_name' => 'Court 1',
        'surface_type' => 'Hard Court',
        'hourly_rate' => 350.00,
        'status' => 'Active'
    ]);
    }
}
