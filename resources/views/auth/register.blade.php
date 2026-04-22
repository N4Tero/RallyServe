<x-layout>

  <x-auth-card>
    <x-slot name="title">Join Rally Serve</x-slot>
    <x-slot name="subtitle">Create an account to start booking courts.</x-slot>

   <form action="/register" method="POST" class="auth-form">
      @csrf
      
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Nathaniel Ereso" 
               value="{{ old('name') }}" 
               class="@error('name') input-error @enderror" required>
        
        @error('name')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" 
               value="{{ old('email') }}" 
               class="@error('email') input-error @enderror" required>
        
        @error('email')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="form-control" required>

<div id="password-checklist" style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 15px; margin-top: 10px; font-size: 14px; color: #6b7280; display: none;">
    <p style="margin: 0 0 10px 0; font-weight: bold; color: #374151;">Password must contain:</p>
    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
        <li id="req-length" class="invalid">❌ At least 8 characters</li>
        <li id="req-upper" class="invalid">❌ One uppercase letter</li>
        
        <li id="req-number" class="invalid">❌ Atleast One number</li>
        <li id="req-symbol" class="invalid">❌ Atleast One symbol (e.g., @$!%*?&)</li>
    </ul>
</div>

<style>
    /* Turn text green and change the icon when valid */
    li.valid { color: #15803d; }
    li.invalid { color: #dc2626; }
</style>

        @error('password')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" 
               class="toggle-password-field @error('password_confirmation') input-error @enderror" required>
      </div>

      <div class="checkbox-group">
        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
        <label for="show-password">Show Password</label>
      </div>
      

      <button type="submit" class="btn btn-primary">Create Account</button>
    </form>

    <div class="auth-footer">
      <p>Already have an account? <a href="/login" class="text-link font-bold">Log In</a></p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById('password');
        const checklistBox = document.getElementById('password-checklist');

        // Requirements list items
        const reqLength = document.getElementById('req-length');
        const reqUpper = document.getElementById('req-upper');
        const reqLower = document.getElementById('req-lower');
        const reqNumber = document.getElementById('req-number');
        const reqSymbol = document.getElementById('req-symbol');

        // Show the checklist only when the user clicks into the password box
        passwordInput.addEventListener('focus', function() {
            checklistBox.style.display = 'block';
        });

        // Listen to every keystroke
        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;

            // 1. Check Length (8+ chars)
            toggleValid(reqLength, val.length >= 8);

            // 2. Check Uppercase
            toggleValid(reqUpper, /[A-Z]/.test(val));

            // 3. Check Lowercase
            toggleValid(reqLower, /[a-z]/.test(val));

            // 4. Check Number
            toggleValid(reqNumber, /[0-9]/.test(val));

            // 5. Check Symbol
            toggleValid(reqSymbol, /[^A-Za-z0-9]/.test(val));
        });

        // Helper function to swap the red X for a green Check
        function toggleValid(element, isValid) {
            if (isValid) {
                element.classList.remove('invalid');
                element.classList.add('valid');
                element.innerHTML = element.innerHTML.replace('❌', '✅');
            } else {
                element.classList.remove('valid');
                element.classList.add('invalid');
                element.innerHTML = element.innerHTML.replace('✅', '❌');
            }
        }
    });
</script>
  </x-auth-card>  

</x-layout>