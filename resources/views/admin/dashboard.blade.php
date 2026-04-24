<x-layout>
    <div style="background-color: #f3f4f6; min-height: 100vh; padding: 2rem 1rem;">
        <div style="max-width: 1100px; margin: 0 auto;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 style="font-size: 1.8rem; font-weight: 900; color: #111827;">Staff Approval Portal</h1>
                <span style="background: #14a84d; color: white; padding: 0.5rem 1rem; border-radius: 50px; font-weight: bold; font-size: 0.8rem;">
                    Admin Session Active
                </span>
            </div>
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
    <a href="{{ route('tournaments.create') }}" 
       style="background: #1f2937; color: white; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s;">
       <span>🏆</span> Add New Tournament
    </a>

    <a href="#" 
       style="background: white; color: #1f2937; border: 1px solid #e5e7eb; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
       <span>📍</span> Manage Facilities
    </a>
</div>
            @if(session('success'))
                <div style="background: #dcfce7; border-left: 4px solid #14a84d; color: #166534; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: white; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                        <tr>
                            <th style="padding: 1rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase;">Reference / User</th>
                            <th style="padding: 1rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase;">Court & Facility</th>
                            <th style="padding: 1rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase;">Date & Time</th>
                            <th style="padding: 1rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase;">Status</th>
                            <th style="padding: 1rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase;">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="color: #374151; font-size: 0.9rem;">
                        @foreach($bookings as $booking)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 1.2rem 1rem;">
                                <div style="font-weight: 800; color: #111827;">{{ $booking->reference_number }}</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">{{ $booking->user->name }}</div>
                            </td>
                            <td style="padding: 1.2rem 1rem;">
                                <div style="font-weight: 600;">{{ $booking->court->court_name }}</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">{{ $booking->court->facility->facility_name }}</div>
                            </td>
                            <td style="padding: 1.2rem 1rem;">
                                <div>{{ date('M d, Y', strtotime($booking->booking_date)) }}</div>
                                <div style="font-size: 0.8rem; color: #14a84d; font-weight: 700;">
                                    {{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }}
                                </div>
                            </td>
                            <td style="padding: 1.2rem 1rem;">
                                @php
                                    $colors = [
                                        'Pending' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                        'Approved' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                        'Cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                    ];
                                    $style = $colors[$booking->status] ?? $colors['Pending'];
                                @endphp
                                <span style="background: {{ $style['bg'] }}; color: {{ $style['text'] }}; padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700;">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td style="padding: 1.2rem 1rem;">
                                <div style="display: flex; gap: 0.5rem;">
                                    @if($booking->status === 'Pending')
                                        <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="Approved">
                                            <button type="submit" style="background: #14a84d; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: bold;">Approve</button>
                                        </form>
                                        
                                        <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="Cancelled">
                                            <button type="submit" style="background: white; color: #991b1b; border: 1px solid #fee2e2; padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: bold;">Reject</button>
                                        </form>
                                    @else
                                        <span style="color: #9ca3af; font-style: italic; font-size: 0.8rem;">No actions available</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="padding: 1rem; background: #f9fafb;">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>