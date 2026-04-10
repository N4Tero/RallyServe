<div class="auth-wrapper">
  <div class="auth-card">
    
    <div class="auth-header">
      <h2>{{ $title }}</h2>
      @if(isset($subtitle))
        <p>{{ $subtitle }}</p>
      @endif
    </div>

    <div class="auth-body">
      {{ $slot }}
    </div>

  </div>
</div>