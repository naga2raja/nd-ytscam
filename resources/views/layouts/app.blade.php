<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


        <!-- Styles App-->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ themeAsset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        {{-- <link rel="stylesheet" href="{{ themeAsset('dist/css/adminlte.min.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ themeAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
  <link rel="stylesheet" type="text/css" 
  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/animate.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/bootstrap.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/flatpickr.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/fontello.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/fontello-codes.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/thumbs-embedded.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/responsive.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ themeUrl('v2/css/color.css') }}">


        

<style>
  nav li a.active {
    color: #4a90e2;
}
/* 
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: skyblue;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
    text-align:left;
  }
}


.all-browsers {
  margin: 0;
  padding: 5px;
  background-color: lightgray;
}

.all-browsers > h1, .browser {
  margin: 10px;
  padding: 5px;
}

.browser {
  background: white;
}

.browser > h2, p {
  margin: 4px;
  font-size: 90%;
}

footer {
  text-align: center;
  padding: 10px;
  background-color: #660009;
  color: white;
  margin-top: 20px;
  color: #FFF;
}
.form-control { border: 1px solid #acadad; }
.error { color:#dc3545; }
.cabcs-pagination svg { width: 15px;  }
.cabcs-pagination .flex.justify-between.flex-1.sm\:hidden {  display: none;  }
.cabcs-pagination p.text-sm.text-gray-700.leading-5 {
    text-align: center;
}
.header a:hover {
    background: none;
}

.appName{
    
}*/


.cabcs-pagination svg { width: 15px;  }
.cabcs-pagination .flex.justify-between.flex-1.sm\:hidden {  display: none;  }
.cabcs-pagination p.text-sm.text-gray-700.leading-5 {
    text-align: center;
}

 /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

header.bg-white.shadow + main {
    min-height: 400px;
}
.error {color: red; }
</style>

    </head>
    <body>
      <div class="loading" style="display:none;">Loading&#8230;</div>
        <div>
      <div class="wrapper hp_1">
        <div>
            @include('layouts.navigation')

            @if(request()->routeIs('video'))
            <section class="banner-section">
              <div class="container">
                  <div class="banner-text">
                      <h2>Welcome to ND-YTSCAM</h2>
                      <a>No more Spam Comments</a>
                  </div><!--banner-text end-->
                  {{-- <h3 class="headline">Video of the Day by <a href="#" title="">newfox media</a></h3> --}}
              </div>
          </section><!--banner-section end-->
          @endif

            <!-- Page Content -->
            <!-- Content Wrapper. Contains page content -->
          <section class="mn-sec">
            <div class="container">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="">
                    {{ $header }}
                </div>
            </header>
            
            
          <!-- /.content-wrapper -->  
            <div class="main-content">
                {{ $slot }}
            </div>
            {{-- <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
              <i class="fas fa-chevron-up"></i>
            </a> --}}
        </div>
          </section>

        <footer class="main-footer pb-4 text-center">          
            <p>Copyright &copy; 2021. Designed by CABC’S Group India</p>          
        </footer>

        </div>

       

        <script>
          @if(Session::has('message'))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
              toastr.success("{{ session('message') }}");
          @endif

          @if(Session::has('error'))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
              toastr.error("{{ session('error') }}");
          @endif

          @if(Session::has('info'))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
              toastr.info("{{ session('info') }}");
          @endif

          @if(Session::has('warning'))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
              toastr.warning("{{ session('warning') }}");
          @endif
        </script>
        <!-- jQuery -->
      {{-- <script src="{{ themeAsset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ themeAsset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ themeAsset('dist/js/adminlte.min.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ themeAsset('dist/js/demo.js') }}"></script> --}}

      <script src="{{ themeUrl('v2/js/jquery.min.js') }}"></script>
      <script src="{{ themeUrl('v2/js/popper.js') }}"></script>
      <script src="{{ themeUrl('v2/js/bootstrap.min.js') }}"></script>
      <script src="{{ themeUrl('v2/js/flatpickr.js') }}"></script>
      <script src="{{ themeUrl('v2/js/script.js') }}"></script>

      <script src="{{ themeAsset('/') }}/assets/vendor/php-email-form/validate.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
      @stack('scripts')
      <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
      </script>
      </div>
    </body>
</html>