<x-layout>
  <x-auth-card>
    <x-slot name="title">Create New Password</x-slot>
    <x-slot name="subtitle">Please enter your new password below.</x-slot>

    <form action="/reset-password" method="POST" class="auth-form">
      @csrf
      
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ request()->email }}" readonly required>
        
        @error('email')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" 
               class="toggle-password-field @error('password') input-error @enderror" required>
        
        @error('password')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" 
               class="toggle-password-field" required>
      </div>

      <div class="checkbox-group">
        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
        <label for="show-password">Show Password</label>
      </div>

      <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
    
  </x-auth-card>
</x-layout>