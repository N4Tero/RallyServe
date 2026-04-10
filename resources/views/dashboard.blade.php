<x-layout>
  <div class="user-dashboard-wrapper">
    
    <div class="dashboard-header">
      <div class="dashboard-title">
        <h1>My Dashboard</h1>
        <p>Manage your bookings and profile.</p>
      </div>
      <button class="btn-outline">Edit Profile</button>
    </div>

    <div class="dashboard-grid">
      
      <div>
        @forelse ($bookings as $booking)
          <div class="reservation-card" style="margin-bottom: 1.5rem;">
            <img src="https://images.unsplash.com/photo-1622279457486-62dcc4a631d6?q=80&w=800&auto=format&fit=crop" alt="Court" class="res-image">
            
            <div class="res-content">
              <div class="res-header">
                @if($booking->status === 'Confirmed')
                  <span class="badge badge-open" style="font-size: 0.7rem;">Confirmed</span>
                @elseif($booking->status === 'Pending')
                  <span class="badge" style="background: #ffedd5; color: #9a3412; font-size: 0.7rem;">Pending</span>
                @else
                  <span class="badge" style="background: #f3f4f6; color: #4b5563; font-size: 0.7rem;">{{ $booking->status }}</span>
                @endif
                
                <h3>{{ $booking->court_name }}</h3>
                <div class="res-location">
                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                  Location details coming soon
                </div>
              </div>

              <div class="res-datetime">
                <div class="dt-block">
                  <svg width="20" height="20" fill="none" stroke="#14a84d" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                  <div class="dt-text">
                    <span>Date</span>
                    <strong>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</strong>
                  </div>
                </div>
                <div class="dt-block">
                  <svg width="20" height="20" fill="none" stroke="#14a84d" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <div class="dt-text">
                    <span>Time</span>
                    <strong>{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</strong>
                  </div>
                </div>
              </div>

              <div class="res-actions">
                <button class="btn-outline" style="width: 100%;">Reschedule</button>
                <button class="btn-cancel">Cancel</button>
              </div>
            </div>
          </div>

        @empty
          <div style="text-align: center; padding: 3rem 1rem; background: white; border-radius: 16px; border: 1px dashed #d1d5db;">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 1rem; color: #9ca3af;"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">No upcoming reservations</h3>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">You haven't booked any courts yet. Ready to play?</p>
            <a href="/find-courts" class="btn btn-primary" style="display: inline-block;">Find a Court</a>
          </div>
        @endforelse
        </div>
      </div>

      <div>
        <div class="account-card">
          <h3>Account Overview</h3>
          
          <div class="profile-summary">
            <div class="avatar">
              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="profile-details">
              <h4>{{ auth()->user()->name }}</h4>
              <p>{{ auth()->user()->email }}</p>
            </div>
          </div>

          <div class="stat-row">
            <span class="stat-label">Total Bookings</span>
            <span class="stat-value">12</span>
          </div>
          <div class="stat-row">
            <span class="stat-label">Favorite Court</span>
            <span class="stat-value">Gensan Smash Arena</span>
          </div>

        </div>
      </div>

    </div>
  </div>

</x-layout>