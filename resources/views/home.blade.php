<x-layout>
    
    <section class="hero-section" style="background-image: url('{{ asset('image/pickleballcourt.png') }}'); background-size: cover; background-position: center; min-height: 450px; display: flex; flex-direction: column; justify-content: center; align-items: center; position: relative;">
    
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); z-index: 1;"></div>

    <div class="text-overlay" style="position: relative; z-index: 2; text-align: center; color: white; margin-bottom: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 0.5rem;">Welcome to Rally Serve</h1>
        <p style="font-size: 1.25rem; font-weight: 600;">Book your perfect Pickleball Court.</p>
        <p style="font-size: 1rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">Discover, compare, and reserve top-rated indoor and outdoor courts instantly. Stop calling around, start rallying.</p>
    </div>

    <div class="search-bar-container" style="position: relative; z-index: 2;">
      <form action="/search" method="GET" style="display: flex; width: 100%; align-items: center;">
        
        <div class="search-field">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          <input type="text" name="location" placeholder="Location or court name...">
        </div>

        <div class="search-divider"></div>

        <div class="search-field">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
          <input type="text" name="date" placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')">
        </div>

        <button type="submit" class="btn-primary btn-search">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          Search
        </button>

      </form>
    </div>
  </section>
</div>


  <section class="tournaments-section">
    <div class="section-container">
      
      <div class="section-header">
        <div class="icon-circle">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
        </div>
        <h2>Upcoming Tournaments</h2>
      </div>

      <div class="tournaments-grid">
        
        @forelse ($tournaments as $tournament)
          <div class="tournament-card">
            <div class="card-top">
              <div>
                <h3 class="card-title">{{ $tournament->title }}</h3>
                <div class="card-meta">
                  <span>📅 {{ $tournament->date_range }}</span>
                  <span>👥 {{ $tournament->format }}</span>
                </div>
              </div>
              
              @if($tournament->status === 'Registration Open')
                <span class="badge badge-open">Registration Open</span>
              @elseif($tournament->status === 'Soon')
                <span class="badge badge-soon">Soon</span>
              @else
                <span class="badge" style="background: #fee2e2; color: #991b1b;">Closed</span>
              @endif
            </div>
            
            <div class="card-bottom">
              <span class="prize-pool" style="{{ $tournament->status !== 'Registration Open' ? 'color: #6b7280;' : '' }}">
                ⚡ {{ $tournament->prize_details }}
              </span>
              
              @if($tournament->status === 'Registration Open')
                <a href="{{ $tournament->registration_link ?? '#' }}" target="_blank" class="btn btn-primary btn-register">Register Now</a>
              @else
                <button class="btn btn-notify" disabled>Notify Me</button>
              @endif
            </div>
          </div>

        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem; color: #6b7280; background: white; border-radius: 12px; border: 1px dashed #d1d5db;">
            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 1rem; opacity: 0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <h3 style="color: #1f2937; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">No upcoming tournaments</h3>
            <p>We are planning our next events. Check back soon!</p>
          </div>
        @endforelse

      </div>

      </div>
    </div>
  </section>
<main style="height: 2000px; padding: 2rem; background-color: #f3f4f6;">
    
  </main>

</x-layout>