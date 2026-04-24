<x-layout>
  <div style="background-color: #f9fafb; min-height: calc(100vh - 70px); padding: 4rem 1rem;">
    
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 3rem; border-radius: 16px; border: 1px solid #e5e7eb; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
      
      <h2 style="font-size: 2.2rem; font-weight: 900; color: #1f2937; margin-top: 0; margin-bottom: 2rem; text-align: center;">Reserve a Court</h2>

      @if($errors->any())
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px;">
            <p style="font-weight: bold; margin: 0 0 0.5rem 0;">Booking Failed</p>
            <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
      @endif

      <form action="{{ route('book.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1.5rem;">
            <label for="court_id" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Select Facility</label>
            <select name="court_id" id="court_id" required 
                    style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 1rem; outline: none; cursor: pointer; box-sizing: border-box;">
                <option value="" disabled {{ !request('preselected_court') ? 'selected' : '' }}>-- Choose an available court --</option>
                
                @foreach($courts as $court)
                    <option value="{{ $court->id }}" {{ request('preselected_court') == $court->id ? 'selected' : '' }}>
                        {{ $court->facility->facility_name }} - {{ $court->court_name }} (₱{{ $court->hourly_rate }}/hr)
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="booking_date" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Play Date</label>
            <input type="date" name="booking_date" id="booking_date" min="{{ date('Y-m-d') }}" required 
                   style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 1rem; outline: none; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 1.5rem; margin-bottom: 2.5rem;">
            <div style="flex: 1;">
                <label for="start_time" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Start Time</label>
                <input type="time" name="start_time" id="start_time" required 
                       style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 1rem; outline: none; box-sizing: border-box;">
            </div>
            <div style="flex: 1;">
                <label for="end_time" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">End Time</label>
                <input type="time" name="end_time" id="end_time" required 
                       style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 1rem; outline: none; box-sizing: border-box;">
            </div>
        </div>

        <button type="submit" 
                style="width: 100%; background-color: #14a84d; color: white; padding: 1.2rem; border-radius: 50px; font-size: 1.1rem; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 4px 6px rgba(20, 168, 77, 0.2);">
            Confirm Reservation Request
        </button>
      </form>
    </div>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const startTimeInput = document.getElementById('start_time');
          const endTimeInput = document.getElementById('end_time');

          startTimeInput.addEventListener('change', function() {
              if(this.value) {
                  endTimeInput.min = this.value;
                  if(endTimeInput.value && endTimeInput.value <= this.value) {
                      endTimeInput.value = '';
                  }
              }
          });
      });
  </script>
</x-layout>