<!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>    <meta charset="utf-8">    <meta name="viewport" content="width=device-width, initial-scale=1">    <title>{{ config('app.name', 'Laravel') }}@hasSection('title') - @yield('title') @endif</title>    <!-- Scripts -->    <script src="{{ asset('js/app.js') }}" defer></script>    <!-- Styles -->    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    @yield('style')</head><body class="antialiased">    @yield('content')</body></html>