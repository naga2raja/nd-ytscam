<x-guest-layout>
    <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="card">
                
                <form method="POST" action="{{ route('login') }}" class="box">
                    @csrf
                <center><h1><img src="/images/cabcs-group-india_logo.png" alt="CABC'S"></h1></center>

                    <!-- Session Status -->
                <x-auth-session-status class="mb-4 alert alert-danger" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

                    
                    <div class="inner-box">
                    <!-- <p class="text-muted" style="color: #ccc;"> Please enter your login and password!</p>  -->
                    <input type="email" id="email" name="email" :value="old('email')" required placeholder="Username">
                    <input 
                        type="password"
                        name="password"
                        required autocomplete="current-password"  placeholder="Password"> 

                    <div class="row">
                        <!-- Remember Me -->
                        <div class="offset-md-2 col-md-5 pl-0">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600" style="color: #444;">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <input type="submit" name="" value="Login" class="btn btn-primary">
                        </div>
                    </div>

                    <div class="col-md-12" style="display: none;">
                        @if (Route::has('password.request'))
                            <a class="forgot text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="col-md-12" style="display: none;">
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-12 pt-5">
                        <a href="/auth/redirect" class="btn btn-info">
                           <img src="/images/google-logo.png" style="width: 30px;"> {{ __('Log in with Google') }}
                        </a>
                    </div>
                    </div>

                </form>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div> <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</x-guest-layout>