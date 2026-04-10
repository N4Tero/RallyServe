<x-layout>
  <div style="background-color: #f3f4f6; min-height: calc(100vh - 70px); padding: 2rem 1rem;">
    <div style="max-width: 800px; margin: 0 auto;">
      
      <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #1f2937; font-weight: 800;">Create New Tournament</h1>
        <p style="color: #6b7280;">Publish a new event to the public homepage.</p>
      </div>

      <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 2.5rem;">
        
        <form action="/admin/tournaments" method="POST" class="auth-form">
          @csrf

          <div class="form-group">
            <label for="title">Tournament Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Gensan Summer Smash 2026" required>
            @error('title') <span class="text-error">{{ $message }}</span> @enderror
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
              <label for="date_range">Dates</label>
              <input type="text" id="date_range" name="date_range" value="{{ old('date_range') }}" placeholder="e.g. March 15-16, 2026" required>
              @error('date_range') <span class="text-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
              <label for="format">Format</label>
              <input type="text" id="format" name="format" value="{{ old('format') }}" placeholder="e.g. Mixed Doubles" required>
              @error('format') <span class="text-error">{{ $message }}</span> @enderror
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
              <label for="status">Registration Status</label>
              <select id="status" name="status" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" required>
                <option value="Soon">Soon</option>
                <option value="Registration Open">Registration Open</option>
                <option value="Closed">Closed</option>
              </select>
              @error('status') <span class="text-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
              <label for="prize_details">Prize Pool / Details</label>
              <input type="text" id="prize_details" name="prize_details" value="{{ old('prize_details') }}" placeholder="e.g. ₱50,000 Total Prize Pool" required>
              @error('prize_details') <span class="text-error">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 2rem;">
            <label for="registration_link">External Registration Link (Optional)</label>
            <input type="url" id="registration_link" name="registration_link" value="{{ old('registration_link') }}" placeholder="https://forms.google.com/...">
            @error('registration_link') <span class="text-error">{{ $message }}</span> @enderror
          </div>

          <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="/admin/dashboard" class="btn" style="padding: 0.85rem 1.5rem; color: #4b5563; border: 1px solid #d1d5db; border-radius: 50px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="width: auto;">Publish Tournament</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</x-layout>