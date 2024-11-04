@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-blue-400 to-teal-400 min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 w-full max-w-md text-left">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">{{__('secrets.link.share')}}</h1>

            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="font-semibold">{{__('secrets.link.expires_in')}}</span> {{ $expires_in }}
                </p>
                <p class="text-gray-700">
                    <span class="font-semibold">{{__('secrets.link.max_views')}}</span> {{ $max_views }}
                </p>
            </div>

            <!-- Secret content -->
            <div class="space-y-4">
                <div>
                    <label for="link" class="flex text-sm mb-2 dark:text-white">{{__('secrets.link.link')}}
                        <x-tooltip>{{ __('secrets.link.link_tooltip') }}</x-tooltip>
                    </label>
                    <div class="relative">
                        <input id="link"
                               name="link"
                               class="block w-full p-3 pr-12 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150 ease-in-out"
                               value="{{$link}}"
                               readonly>
                        <button onclick="copyToClipboard(event, 'link')"
                                class="absolute inset-y-0 right-0 px-3 flex items-center hover:text-teal-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="revoke_token"
                           class="flex text-sm mb-2 dark:text-white">{{__('secrets.link.revoke_token')}}
                        <x-tooltip>{{ __('secrets.link.revoke_token_tooltip') }}</x-tooltip>
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <input id="revoke_token"
                               :type="show ? 'text' : 'password'"
                               name="revoke_token"
                               required
                               readonly
                               class="block w-full p-3 pr-24 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                               value={{$revoke_token}}>
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button type="button" @click="show = !show"
                                    class="px-3 h-full flex items-center hover:text-teal-600 transition-colors border-l">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path d="M12 4.5c-5.25 0-9 3.75-9 7.5s3.75 7.5 9 7.5 9-3.75 9-7.5-3.75-7.5-9-7.5z"/>
                                    <path d="M12 15c2.25 0 4-1.75 4-4s-1.75-4-4-4-4 1.75-4 4 1.75 4 4 4z"/>
                                </svg>
                            </button>
                            <button onclick="copyToClipboard(event, 'revoke_token')"
                                    class="px-3 h-full flex items-center hover:text-teal-600 transition-colors border-l">
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
        </div>
    </div>

    <script>
        const hash = generateUrl();
        const link = document.getElementById('link');
        link.value = link.value + hash;
    </script>
@endsection
