@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-blue-400 to-teal-400 min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full">
            <h1 class="text-2xl font-semibold text-gray-800">{{ __('secrets.edit.title') }}</h1>
            <p class="text-sm text-gray-600 mb-8">{{ __('secrets.edit.description') }}</p>

            <form action="{{ route('secrets.destroy', $token) }}" method="POST" id="secretForm">
                @csrf
                @method('DELETE')

                <!-- Secret content -->
                <div class="mb-6">
                    <label for="revoke_token" class="text-sm mb-2 text-gray-700 flex items-center">
                        {{ __('secrets.edit.revoke_token') }}
                        <x-tooltip>{{ __('secrets.edit.revoke_token_tooltip') }}</x-tooltip>
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <input id="revoke_token" :type="show ? 'text' : 'revoke_token'"
                               name="revoke_token"
                               class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                               placeholder="{{ __('secrets.edit.enter_revoke_token_placeholder') }}"
                               value="{{old('content')}}">
                        <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 focus:text-teal-500">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M12 4.5c-5.25 0-9 3.75-9 7.5s3.75 7.5 9 7.5 9-3.75 9-7.5-3.75-7.5-9-7.5z"/>
                                <path d="M12 15c2.25 0 4-1.75 4-4s-1.75-4-4-4-4 1.75-4 4 1.75 4 4 4z"/>
                            </svg>
                        </button>
                    </div>
                    @error('revoke_token')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 bg-teal-500 text-white font-semibold rounded-md shadow-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    {{ __('secrets.edit.revoke_btn') }}
                </button>
            </form>
        </div>
    </div>
@endsection
