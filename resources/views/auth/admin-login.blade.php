<x-layout>

  <x-auth-card>
    <x-slot name="title">Rally Serve</x-slot>
    <x-slot name="subtitle">Admin Portal.</x-slot>

    <form action="/login" method="POST" class="auth-form">
      @csrf 
      
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
        <input type="password" id="password" name="password" placeholder="••••••••" 
               class="toggle-password-field @error('password') input-error @enderror" required>
        
        @error('password')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <div class="checkbox-group">
        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
        <label for="show-password">Show Password</label>
      </div>

      <div class="form-actions">
        <a href="/forgot-password" class="text-link">Forgot Password?</a>
      </div>

      <button type="submit" class="btn btn-primary">Log In</button>
    </form>

    <div class="auth-footer">
      <p>Don't have an account? <a href="/register" class="text-link font-bold">Sign Up</a></p>
    </div>
    
  </x-auth-card>

</x-layout>