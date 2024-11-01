<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{URL::asset('js/encryption.js')}}"></script>
    <script src="{{URL::asset('js/clipboard.js')}}"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 to-teal-400 h-screen flex items-center justify-center">
<main class="bg-white rounded-lg shadow-lg p-8 w-1/3 text-left">
    @yield('content')
</main>
</body>
</html>
