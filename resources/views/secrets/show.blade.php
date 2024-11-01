@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">View Your Secret Link</h1>
    {{--    <p class="text-sm text-gray-600 mb-6">This link allows you to securely access your secret.</p>--}}

    <div class="mb-4 text-left mt-8">
            <p class="text-gray-700"><span class="font-semibold">Expires in: </span>{{ $expires_in }}</p>
            <p class="text-gray-700"><span class="font-semibold">Views: </span>{{ $views }} left</p>
    </div>

    <!-- Secret content -->
    <div class="mt-8">
        <label for="content" class="flex text-sm mb-2 dark:text-white">Secret </label>
        <div class="relative" x-data="{ show: false }">
            <input id="content" :type="show ? 'text' : 'password'"
                   name="content"
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out"
                   placeholder="Enter your secret..."
                   value="{{$secret}}"
                   readonly>
            <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-r-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor">
                    <path d="M12 4.5c-5.25 0-9 3.75-9 7.5s3.75 7.5 9 7.5 9-3.75 9-7.5-3.75-7.5-9-7.5z"/>
                    <path d="M12 15c2.25 0 4-1.75 4-4s-1.75-4-4-4-4 1.75-4 4 1.75 4 4 4z"/>
                </svg>
            </button>
        </div>
        <button id="copyBtn" onclick="copyToClipboard('content','copyBtn')"
                class="w-full mt-3 py-3 bg-teal-400 text-white font-semibold rounded-md shadow hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out">
            Copy
        </button>
    </div>

    <script defer>
        const content = document.getElementById('content');
        decryptContent(content.value).then((value) => {
            content.value = value;
        }).catch(error => {
            console.error("Failed to decrypt content:", error);
        });
    </script>
@endsection
