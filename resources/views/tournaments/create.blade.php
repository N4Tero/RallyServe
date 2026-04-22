<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tournament | Rally Serve Admin</title>
    <style>
        body { font-family: sans-serif; background-color: #f3f4f6; padding: 2rem; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; font-weight: bold; margin-bottom: 0.5rem; }
        input, textarea { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
        .btn-primary { 
            background-color: var(--primary-green, #14a84d); 
            color: white; 
            padding: 0.75rem 1.5rem; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-weight: bold;
            width: 100%;
        }
        .btn-primary:hover { background-color: #118c40; }
        .error { color: red; font-size: 0.875rem; margin-top: 0.25rem; }
    </style>
</head>
<body>

<div class="container">
    <h2>Create New Tournament</h2>
    
    <form action="{{ route('tournaments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Tournament Title</label>
            <input type="text" id="title" name="title" required placeholder="e.g., Summer Smash 2026">
        </div>

        <div class="form-group">
            <label for="date_range">Date Range</label>
            <input type="text" id="date_range" name="date_range" required placeholder="e.g., March 26-27 2026">
        </div>

        <div class="form-group">
            <label for="format">Tournament Format</label>
            <input type="text" id="format" name="format" required placeholder="e.g., Singles & Mix Doubles">
        </div>

        <div class="form-group">
            <label for="status">Current Status</label>
            <select id="status" name="status" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
                <option value="Soon">Soon</option>
                <option value="Registration Open">Registration Open</option>
                <option value="Closed">Closed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="prize_details">Prize Details</label>
            <input type="text" id="prize_details" name="prize_details" required placeholder="e.g., PHP 10,000">
        </div>

        <div class="form-group">
            <label for="registration_link">Registration Link (Optional)</label>
            <input type="url" id="registration_link" name="registration_link" placeholder="https://forms.gle/...">
        </div>

        <button type="submit" class="btn-primary">Publish Tournament</button>
    </form>
</div>

</body>
</html>