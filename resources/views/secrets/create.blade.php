@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-blue-400 to-teal-400 min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full">
            <div class="" x-data="{ show: true }" x-transition x-show="show"
                 x-init="setTimeout(() => show = false, 2000)">
                @if(session('success'))
                    <div class="bg-teal-500 text-white font-bold rounded-lg px-4 py-2 mb-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <h1 class="text-2xl font-semibold text-gray-800">{{ __('secrets.create.create') }}</h1>
            <p class="text-sm text-gray-600 mb-8">{{ __('hero.encryption.description') }}</p>

            <form action="{{ route('secrets.store') }}" method="POST" id="secretForm">
                @csrf

                <!-- Secret content -->
                <div class="mb-6">
                    <label for="content" class="text-sm mb-2 text-gray-700 flex items-center">
                        {{ __('secrets.create.secret') }}
                        <x-tooltip>{{ __('secrets.create.secret_tooltip') }}</x-tooltip>
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <input id="content" :type="show ? 'text' : 'password'"
                               name="content"
                               required
                               class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                               placeholder="{{ __('secrets.create.enter_secret_placeholder') }}"
                               value="">
                        <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 focus:text-teal-500">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M12 4.5c-5.25 0-9 3.75-9 7.5s3.75 7.5 9 7.5 9-3.75 9-7.5-3.75-7.5-9-7.5z"/>
                                <path d="M12 15c2.25 0 4-1.75 4-4s-1.75-4-4-4-4 1.75-4 4 1.75 4 4 4z"/>
                            </svg>
                        </button>
                    </div>
                    @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expire In Selection & Max Views Input -->
                <div class="flex gap-4 mb-6">
                    <!-- Expire In Selection -->
                    <div class="w-1/2">
                        <label for="expires_in" class="text-sm font-medium text-gray-700 flex items-center">
                            {{ __('secrets.create.expires_in') }}
                            <x-tooltip>{{ __('secrets.create.expires_in_tooltip') }}</x-tooltip>
                        </label>
                        <select name="expires_in" id="expires_in"
                                class="mt-1 block w-full p-3 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                            @foreach([1, 12, 24, 48, 72, 168] as $hours)
                                <option {{ old('expires_in') == $hours ? 'selected' : '' }} value="{{ $hours }}">
                                    {{ $hours }} {{ __('secrets.create.hours') }}
                                </option>
                            @endforeach
                        </select>
                        @error('expires_in')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Views Input -->
                    <div class="w-1/2">
                        <label for="max_views" class="text-sm font-medium text-gray-700 flex items-center">
                            {{ __('secrets.create.max_views') }}
                            <x-tooltip>{{ __('secrets.create.max_views_tooltip') }}</x-tooltip>
                        </label>
                        <input type="number" name="max_views" id="max_views" min="1" max="15"
                               value="{{old('max_views')}}"
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                               placeholder="{{ __('secrets.create.enter_max_views_placeholder') }}"/>
                        @error('max_views')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="button" onclick="encryptAndSubmit()"
                        class="w-full py-3 bg-teal-500 text-white font-semibold rounded-md shadow-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    {{ __('secrets.create.create') }}
                </button>

                <div class="mt-4 text-center">
                    <a href="{{ route('index') }}"
                       class="text-gray-400 underline text-sm hover:text-teal-500">{{ __('secrets.create.how_does_it_work') }}</a>
                </div>
            </form>
        </div>
    </div>

    <script defer>
        async function encryptAndSubmit() {
            const form = document.getElementById('secretForm');
            const secretContent = document.getElementById('content');

            // Don't encrypt if the secret content is empty
            if (secretContent.value.length === 0) {
                form.submit();
                return;
            }

            try {
                secretContent.value = await encrypt(secretContent.value);
                form.submit();
            } catch (error) {
                console.error("Failed to encrypt content:", error);
            }
        }
    </script>

@endsection
