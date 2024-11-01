<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{URL::asset('js/encryption.js')}}"></script>
</head>
<body class="">
<!-- Navigation Bar -->
<nav class="bg-white shadow-lg py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-teal-500">{{config('app.name')}}</a>
        <div class="hidden md:flex space-x-6">
            <a href="/#hero" class="text-gray-600 hover:text-teal-500">{{__('navigation.home')}}</a>
            <a href="/#faq" class="text-gray-600 hover:text-teal-500">{{__('navigation.faq')}}</a>
            <a href="/#opensource" class="text-gray-600 hover:text-teal-500">{{__('navigation.opensource')}}</a>
        </div>
        <a href="{{ route('secrets.create') }}"
           class="px-4 py-2 bg-teal-500 text-white font-semibold rounded-md shadow hover:bg-teal-600 transition duration-150">
            {{__('navigation.share_secret')}}
        </a>
    </div>
</nav>
<main>
    @yield('content')
</main>
</body>

<!-- Footer -->
<footer class="bg-white py-6 mt-12">
    <div class="text-center text-gray-600 text-sm">
        {!!__('footer.copyright',['year' => date('Y'), 'appname' => config('app.name')])!!}
        {{__('footer.made_with_love')}}
        <a href="https://gerwinkuijntjes.nl" class="text-teal-500 hover:underline" target="_blank">Gerwin Kuijntjes</a>
    </div>
</footer>


</html>
