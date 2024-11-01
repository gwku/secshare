@extends('layouts.app')

@section('content')
    <div class="text-left max-w-lg mx-auto pb-8 bg-white rounded-lg">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Create a Secret Link</h1>
        <p class="text-sm text-gray-600 mb-6">Securely share your password via a secret link. This tool uses
            E2E-encryption, TLS encryption, and encryption at rest.</p>
        <form action="{{ route('secrets.store') }}" method="POST" id="secretForm">
            @csrf

            <!-- Secret content -->
            <div class="mb-6">
                <label for="content" class="flex text-sm mb-2 dark:text-white">Secret
                    <x-tooltip>Secret you want to share.</x-tooltip>
                </label>
                <div class="relative" x-data="{ show: false }">
                    <input id="content" :type="show ? 'text' : 'password'"
                           name="content"
                           class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out"
                           placeholder="Enter your secret..."
                           value="{{old('content')}}">
                    <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-r-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                        <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor">
                            <path d="M12 4.5c-5.25 0-9 3.75-9 7.5s3.75 7.5 9 7.5 9-3.75 9-7.5-3.75-7.5-9-7.5z"/>
                            <path d="M12 15c2.25 0 4-1.75 4-4s-1.75-4-4-4-4 1.75-4 4 1.75 4 4 4z"/>
                        </svg>
                    </button>
                </div>
                @error('content')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Expire In Selection -->
            <div class="mb-6">
                <label for="expires_in" class="flex text-sm font-medium text-gray-700">Expires In
                    <x-tooltip>After this moment, your link will become invalid.</x-tooltip>
                </label>
                <select name="expires_in" id="expires_in"
                        class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                    @foreach([1, 12, 24, 48, 72, 168] as $hours)
                        <option {{old('expires_in') == $hours ? "selected" : ""}}  value="{{ $hours }}">{{ $hours }} uur
                        </option>
                    @endforeach
                </select>

                @error('expires_in')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Max Views Input -->
            <div class="mb-6">
                <label for="max_views" class="flex text-sm font-medium text-gray-700">Max
                    Views (max. 15)
                    <x-tooltip>Max amount of times this password can be viewed.</x-tooltip>
                </label>
                <input type="number" name="max_views" id="max_views" min="1" value="{{old('max_views')}}"
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out"
                       placeholder="Enter max views"/>
                @error('max_views')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="button" onclick="encryptAndSubmit()"
                        class="w-full mt-3 py-3 bg-teal-400 text-white font-semibold rounded-md shadow hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                    Create
                </button>
            </div>
        </form>
    </div>

    <script defer>
        async function encryptAndSubmit() {
            // Get the secret content
            const secretContent = document.getElementById('content');
            const base64Encrypted = await encrypt(secretContent.value);

            // Submit the form with the encrypted content
            const form = document.getElementById('secretForm');
            secretContent.value = base64Encrypted;
            form.submit();
        }
    </script>
@endsection
