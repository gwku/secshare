@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-blue-400 to-teal-400 h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-2/3 text-left">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{__('secrets.link.share')}}</h1>

            <div class="mb-4">
                <p class="text-gray-700"><span class="font-semibold">{{__('secrets.link.expires_in')}}</span>{{ $expires_in }}</p>
                <p class="text-gray-700"><span class="font-semibold">{{__('secrets.link.max_views')}}</span>{{ $max_views }} left</p>
            </div>

            <!-- Secret content -->
            <div>
                <label for="content" class="flex text-sm mb-2 dark:text-white">{{__('secrets.link.link')}}</label>
                <div class="relative" x-data="{ show: false }">
                    <input id="link"
                           name="link"
                           class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out"
                           placeholder="{{__('secrets.link.enter_secret_placeholder')}}"
                           value="{{$link}}"
                           readonly>
                </div>
                <button id="copyBtn" onclick="copyToClipboard()"
                        class="w-full mt-3 py-3 bg-teal-400 text-white font-semibold rounded-md shadow hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 ease-in-out">
                    {{__('secrets.link.copy')}}
                </button>
            </div>
        </div>
    </div>

    <script>
        const hash = generateUrl();
        const link = document.getElementById('link');
        link.value = link.value + hash;

        async function copyToClipboard() {
            const link = document.getElementById('link');
            const copyBtn = document.getElementById('copyBtn');
            await navigator.clipboard.writeText(link.value)
            const copyBtnText = copyBtn.textContent;
            copyBtn.innerHTML = '&check;'
            setTimeout(() => {
                copyBtn.innerHTML = copyBtnText;
            }, 1300);
        }
    </script>
@endsection
