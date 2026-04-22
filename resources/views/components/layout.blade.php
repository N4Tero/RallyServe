<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rally Reserve</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="header">
    <button class="menu-toggle" aria-label="Toggle navigation">
    ☰
  </button>    
   <nav class="navbar">
  <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
  
  <a href="/find-courts" class="nav-link {{ request()->is('find-courts*') ? 'active' : '' }}">Find Courts</a>
  
  @auth
    <a href="{{ auth()->user()->role === 'admin' ? '/admin/dashboard' : '/dashboard' }}" 
       class="nav-link {{ (request()->is('dashboard*') || request()->is('admin*')) ? 'active' : '' }}">
       Dashboard
    </a>
  @endauth
</nav>
        
       
    <h1 class="text-2xl font-bold">Rally Reserve</h1>
    <div class="auth-buttons">
  @auth
        <span class="user-greeting">Hi, {{ auth()->user()->name }}</span>
        
        <form action="/logout" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-login">Log Out</button>
        </form>
      @endauth

      @guest
        <a href="/login" class="btn btn-login">Log In</a>
        <a href="/register" class="btn btn-signup">Sign Up</a>
      @endguest
    </div>
    </header>
    <main>
        {{ $slot }}
    </main>
<script>
      function togglePasswordVisibility() {
        // Find all inputs with this specific class
        const passwordFields = document.querySelectorAll('.toggle-password-field');
        const checkbox = document.getElementById('show-password');

        // Loop through them (this handles both the main and confirm passwords at once!)
        passwordFields.forEach(field => {
          if (checkbox.checked) {
            field.type = "text"; // Show the text
          } else {
            field.type = "password"; // Hide it back to dots
          }
        });
      }


    document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const menuToggle = document.querySelector('.menu-toggle');

    if (menuToggle && header) {
      menuToggle.addEventListener('click', () => {
        header.classList.toggle('open');
      });
    }
  });
    </script>
</body>

</html>