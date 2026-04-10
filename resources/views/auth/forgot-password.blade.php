<x-layout>
  <x-auth-card>
    <x-slot name="title">Reset Password</x-slot>
    <x-slot name="subtitle">Enter your email and we will send you a secure reset link.</x-slot>

    @if (session('status'))
      <div style="color: #14a84d; margin-bottom: 1rem; text-align: center; font-weight: bold;">
        {{ session('status') }}
      </div>
    @endif

    <form action="/forgot-password" method="POST" class="auth-form">
      @csrf
      
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required>
        
        @error('email')
          <span class="text-error">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>
    
    <div class="auth-footer">
      <p>Remembered your password? <a href="/login" class="text-link font-bold">Log In</a></p>
    </div>
  </x-auth-card>
</x-layout>