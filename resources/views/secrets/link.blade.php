@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Share Your Secret Link</h1>

    <div class="mb-4">
        <p class="text-gray-700"><span class="font-semibold">Expires in: </span>{{ $expires_in }}</p>
        <p class="text-gray-700"><span class="font-semibold">Max views: </span>{{ $max_views }} left</p>
    </div>

    <!-- Secret content -->
    <div>
        <label for="content" class="flex text-sm mb-2 dark:text-white">link </label>
        <div class="relative" x-data="{ show: false }">
            <input id="link"
                   name="link"
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out"
                   placeholder="Enter your secret..."
                   value="{{$link}}"
                   readonly>
        </div>
        <button id="copyBtn" onclick="copyToClipboard('link','copyBtn')"
                class="w-full mt-3 py-3 bg-teal-400 text-white font-semibold rounded-md shadow hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 ease-in-out">
            Copy
        </button>
    </div>

    <script>
        const hash = generateUrl();
        const link = document.getElementById('link');
        link.value = link.value + hash;
    </script>
@endsection
