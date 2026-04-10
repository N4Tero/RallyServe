<x-layout>
  <div style="background-color: #f9fafb; min-height: calc(100vh - 70px); padding: 3rem 1rem;">
    <div style="max-width: 600px; margin: 0 auto;">
      
      <div style="text-align: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2.2rem; font-weight: 800; color: #1f2937;">Secure Your Court</h1>
        <p style="color: #6b7280; font-size: 1.05rem;">Pick a date and time for your match.</p>
      </div>

      <div style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
        
        <form action="/bookings" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
          @csrf

          <div>
            <label for="court_name" style="display: block; font-weight: 700; color: #374151; margin-bottom: 0.5rem;">Court Facility</label>
            <input type="text" id="court_name" name="court_name" value="{{ $courtName }}" readonly
                   style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f3f4f6; color: #4b5563; font-weight: 600; font-size: 1rem; outline: none; box-sizing: border-box;">
            @error('court_name') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
          </div>

          <div>
            <label for="booking_date" style="display: block; font-weight: 700; color: #374151; margin-bottom: 0.5rem;">Date</label>
            <input type="date" id="booking_date" name="booking_date" min="{{ date('Y-m-d') }}" required
                   style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; color: #1f2937; outline: none; box-sizing: border-box;">
            @error('booking_date') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
              <label for="start_time" style="display: block; font-weight: 700; color: #374151; margin-bottom: 0.5rem;">Start Time</label>
              <input type="time" id="start_time" name="start_time" required
                     style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; color: #1f2937; outline: none; box-sizing: border-box;">
              @error('start_time') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="end_time" style="display: block; font-weight: 700; color: #374151; margin-bottom: 0.5rem;">End Time</label>
              <input type="time" id="end_time" name="end_time" required
                     style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; color: #1f2937; outline: none; box-sizing: border-box;">
              @error('end_time') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>
          </div>

          <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 800; border-radius: 8px; border: none; cursor: pointer;">
              Confirm Reservation
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>
</x-layout>