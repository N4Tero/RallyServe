<x-layout>
  <div style="background-color: #ffffff; min-height: calc(100vh - 70px); padding: 2rem 1rem;">
    <div class="admin-container">
      
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <h1 style="font-size: 2.2rem; color: #000000; font-weight: 900; letter-spacing: -0.5px;">Facility Management</h1>
          <p style="color: #6b7280; font-size: 1.05rem;">Gensan Smash Arena - Staff Dashboard</p>
        </div>
        
        <a href="/admin/tournaments/create" class="btn btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
          Add Tournament
        </a>
      </div>

      <div class="metrics-grid">
        
        <div class="metric-card">
          <div class="metric-icon icon-green">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h.01M15 12h.01M12 15h.01"></path></svg>
          </div>
          <div class="metric-info">
            <p>Today's Bookings</p>
            <h3>24</h3>
          </div>
        </div>

        <div class="metric-card">
          <div class="metric-icon icon-blue">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          </div>
          <div class="metric-info">
            <p>Active Players</p>
            <h3>18</h3>
          </div>
        </div>

        <div class="metric-card">
          <div class="metric-icon icon-green">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
          </div>
          <div class="metric-info">
            <p>Court Utilization</p>
            <h3>85%</h3>
          </div>
        </div>

      </div>

      <div style="max-width: 850px;">
        <div class="schedule-card">
          
          <div class="schedule-header">
            <h2>Today's Schedule</h2>
            <p>Recent and upcoming reservations for your courts.</p>
          </div>

          <div class="schedule-list">
            
            <div class="schedule-item">
              <div class="schedule-info">
                <h4>Maria Santos</h4>
                <p>06:00 PM - 07:00 PM • Court 1</p>
              </div>
              <div class="schedule-actions">
                <span class="status-badge status-confirmed">Confirmed</span>
                <button class="btn-manage">Manage</button>
              </div>
            </div>

            <div class="schedule-item">
              <div class="schedule-info">
                <h4>Carlos Reyes</h4>
                <p>07:00 PM - 09:00 PM • Court 2</p>
              </div>
              <div class="schedule-actions">
                <span class="status-badge status-checked">Checked In</span>
                <button class="btn-manage">Manage</button>
              </div>
            </div>

            <div class="schedule-item">
              <div class="schedule-info">
                <h4>Ana Garcia</h4>
                <p>08:00 PM - 09:00 PM • Court 1</p>
              </div>
              <div class="schedule-actions">
                <span class="status-badge status-pending">Pending</span>
                <button class="btn-manage">Manage</button>
              </div>
            </div>

          </div>

          <a href="#" class="view-all-link">View All Bookings</a>
        </div>
      </div>

    </div>
  </div>
</x-layout>