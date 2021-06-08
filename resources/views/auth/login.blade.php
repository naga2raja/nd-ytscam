<x-guest-layout>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="{{ themeAsset('/') }}/assets/img/nd-ytscam-logo-mr.png" alt="ND-YTSCAM" style="width: 100%"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <!-- Session Status -->
      <x-auth-session-status class="alert alert-danger" :status="session('status')" />

      <!-- Validation Errors -->
      <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
<!--
      <form method="POST" action="{{ route('login') }}">
         @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email" :value="old('email')" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" autocomplete="current-password" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          
        </div>
      </form>
    -->

      <div class="social-auth-links text-center mb-3">
        <!-- <p>- OR -</p> -->
        <!-- <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a> -->
        <a href="/auth/redirect" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Sign in using Google
        </a>
        <p class="login-box-msg"><br> YouTube channel owner login email address to be used for sign in.</p>
      </div>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</x-guest-layout>