<x-layout>
    <div style="background-color: #f3f4f6; min-height: 100vh; padding: 4rem 1rem;">
        
        <div style="max-width: 650px; margin: 0 auto; background: white; padding: 3rem; border-radius: 16px; border: 1px solid #e5e7eb; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            
            <div style="text-align: center; margin-bottom: 2.5rem;">
                <h2 style="font-size: 2rem; font-weight: 900; color: #111827; margin-bottom: 0.5rem;">Create Tournament</h2>
                <p style="color: #6b7280;">Set up a new event for the Rally Reserve community.</p>
            </div>

            @if($errors->any())
                <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 2rem; border-radius: 4px;">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tournaments.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Event Name</label>
                    <input type="text" name="name" id="name" placeholder="e.g. Summer Smash 2026" required 
                           style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; box-sizing: border-box;">
                </div>

                <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div style="flex: 1;">
                        <label for="start_date" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Start Date</label>
                        <input type="date" name="start_date" id="start_date" min="{{ date('Y-m-d') }}" required 
                               style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; box-sizing: border-box;">
                    </div>
                    <div style="flex: 1;">
                        <label for="end_date" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">End Date</label>
                        <input type="date" name="end_date" id="end_date" min="{{ date('Y-m-d') }}" required 
                               style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; box-sizing: border-box;">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="format" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Tournament Format</label>
                    <select name="format" id="format" required 
                            style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: white; font-size: 1rem; cursor: pointer; box-sizing: border-box;">
                        <option value="" disabled selected>-- Choose a format --</option>
                        <option value="Singles">Singles</option>
                        <option value="Doubles">Doubles</option>
                        <option value="Mixed Doubles">Mixed Doubles</option>
                    </select>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <label for="description" style="display: block; color: #374151; font-weight: 800; margin-bottom: 0.5rem;">Details & Prizes</label>
                    <textarea name="description" id="description" rows="4" placeholder="Mention registration fees, rules, or prizes..." 
                              style="width: 100%; padding: 0.9rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; font-family: inherit; box-sizing: border-box;"></textarea>
                </div>

                <button type="submit" 
                        style="width: 100%; background-color: #1f2937; color: white; padding: 1.2rem; border-radius: 12px; font-size: 1.1rem; font-weight: 800; border: none; cursor: pointer; transition: background 0.2s;">
                    Publish Tournament
                </button>
                
                <a href="{{ route('admin.dashboard') }}" style="display: block; text-align: center; margin-top: 1.5rem; color: #6b7280; text-decoration: none; font-size: 0.9rem;">
                    Cancel and Return to Dashboard
                </a>
            </form>
        </div>
    </div>

    <script>
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        startDate.addEventListener('change', function() {
            if (this.value) {
                endDate.min = this.value;
                if (endDate.value && endDate.value < this.value) {
                    endDate.value = '';
                }
            }
        });
    </script>
</x-layout>