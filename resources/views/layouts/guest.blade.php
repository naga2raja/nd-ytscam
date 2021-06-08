<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ themeAsset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ themeAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ themeAsset('dist/css/adminlte.min.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>      
        <style>
            .card, .login-card-body, .register-card-body { background: none; box-shadow: none; border: 0px;}
        </style>  
    </head>
    <body class="hold-transition login-page" style="/*background-color: #00DBDE;
    background-image: linear-gradient(90deg, #00DBDE 0%, #FC00FF 100%);*/ background: #000;
    ">
        <div>
            {{ $slot }}
        </div>
    </body>
</html>