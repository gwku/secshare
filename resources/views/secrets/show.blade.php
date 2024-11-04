@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-blue-400 to-teal-400 min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 w-full max-w-md text-left">

            <h1 class="text-2xl font-semibold text-gray-800">{{__('secrets.show.title')}}</h1>
            <div class="mt-2">
                <a class="text-red-400" href="{{route('secrets.edit',$token)}}">Revoke this link</a>
            </div>

            <div class="mb-4 text-left mt-6">
                <p class="text-gray-700"><span
                        class="font-semibold">{{__('secrets.show.expires_in')}}</span>{{ $expires_in }}</p>
                <p class="text-gray-700"><span
                        class="font-semibold">{{__('secrets.show.views_left')}}</span>{{ $views }} left</p>
            </div>

            <!-- Secret content -->
            <div class="mt-8">
                <label for="content" class="flex text-sm mb-2 dark:text-white">{{__('secrets.show.secret')}}
                    <x-tooltip>{{ __('secrets.show.secret_tooltip') }}</x-tooltip>
                </label>
                <div class="relative" x-data="{ show: false }">
                    <input id="content"
                           :type="show ? 'text' : 'password'"
                           name="content"
                           readonly
                           class="block w-full p-3 pr-16 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                           value="{{ $secret }}">
                    <div class="absolute inset-y-0 right-0 flex items-center space-x-2">
                        <button type="button" @click="show = !show"
                                class="px-2 h-full flex items-center hover:text-teal-600 transition-colors border-l">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M12 4.5c-5.25 0-9 3.75-9 7.5s3.75 7.5 9 7.5 9-3.75 9-7.5-3.75-7.5-9-7.5z"/>
                                <path d="M12 15c2.25 0 4-1.75 4-4s-1.75-4-4-4-4 1.75-4 4 1.75 4 4 4z"/>
                            </svg>
                        </button>
                        <button onclick="copyToClipboard(event, 'content')"
                                class="px-2 h-full flex items-center hover:text-teal-600 transition-colors border-l">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            async function decryptContent() {
                const content = document.getElementById('content');

                try {
                    content.value = await decrypt(content.value);
                } catch (error) {
                    console.error("Failed to decrypt content:", error);
                }
            }

            decryptContent();
        </script>
@endsection
