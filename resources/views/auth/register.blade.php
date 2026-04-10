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
        <input type="password" id="password" name="password" placeholder="••••••••" 
               class="toggle-password-field @error('password') input-error @enderror" required>
        
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
  </x-auth-card>  

</x-layout>