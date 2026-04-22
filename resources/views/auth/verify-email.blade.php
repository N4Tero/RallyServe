<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Rally ReServe</title>
    <style>
        /* --- 1. PAGE BACKGROUND COLOR --- */
        /* Currently a soft gray (#f3f4f6). Change it to match your site's background. */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f3f4f6; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        /* The White Card */
        .card { background: white; padding: 2.5rem; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 400px; text-align: center; }
        
        /* The Success Message Box */
        .success-message { color: #15803d; background-color: #dcfce3; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }

        /* --- 2. MAIN BUTTON COLOR --- */
        /* Change 'background-color' to your system's exact hex code */
        .btn-primary { 
            background-color: #14a84d; /* <-- CHANGE THIS HEX CODE */
            color: white; 
            border: none; 
            padding: 12px 15px; 
            border-radius: 6px; 
            cursor: pointer; 
            width: 100%; 
            margin-bottom: 15px; 
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        /* --- 3. BUTTON HOVER COLOR --- */
        /* Change this to a slightly darker version of your main color */
        .btn-primary:hover { 
            background-color: #0f7d39; /* <-- CHANGE THIS HEX CODE */
        }

        /* The Log Out Link */
        .btn-link { background: none; border: none; color: #6b7280; text-decoration: underline; cursor: pointer; font-size: 14px; transition: color 0.2s; }
        .btn-link:hover { color: #374151; }
        
        h2 { margin-top: 0; color: #111827; }
        p { color: #4b5563; font-size: 15px; line-height: 1.5; margin-bottom: 25px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Check Your Email</h2>
        
        <p>
            Thanks for signing up for Rally Serve! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        </p>

        @if (session('message'))
            <div class="success-message">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-link">
                Log Out
            </button>
        </form>
    </div>

</body>
</html>