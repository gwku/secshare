@extends('layouts.app')

@section('content')
    <div
        class="bg-gradient-to-br from-blue-400 to-teal-400 min-h-screen flex items-center justify-center px-4 sm:px-16 py-8 sm:py-16">
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-8 w-full">
            <div class="max-w-xl mx-auto">
                <!-- Hero Section -->
                <div id="hero" class="text-center mt-12 mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-br from-blue-400 to-teal-400">
                        {{config('app.name')}}
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600">
                        {{__('hero.encryption.description')}}
                    </p>
                    <p class="text-base sm:text-lg text-gray-500 mt-2">
                        {{__('hero.anonymity.description')}}
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                    <div class="p-4 border border-gray-100 rounded-lg bg-gray-50">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <h3 class="font-semibold text-gray-800">{{__('feature.encryption.title')}}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{__('feature.encryption.description')}}</p>
                    </div>

                    <div class="p-4 border border-gray-100 rounded-lg bg-gray-50">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="font-semibold text-gray-800">{{__('feature.self_destruct.title')}}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{__('feature.self_destruct.description')}}</p>
                    </div>

                    <div class="p-4 border border-gray-100 rounded-lg bg-gray-50">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <h3 class="font-semibold text-gray-800">{{__('feature.view_limits.title')}}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{__('feature.view_limits.description')}}</p>
                    </div>

                    <div class="p-4 border border-gray-100 rounded-lg bg-gray-50">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <h3 class="font-semibold text-gray-800">{{__('feature.tls_protection.title')}}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{__('feature.tls_protection.description')}}</p>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="text-center mb-12">
                    <a href="{{route('secrets.create')}}"
                       class="inline-block px-6 py-3 sm:px-8 sm:py-4 bg-teal-400 text-white font-semibold rounded-md shadow hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                        {{__('cta.create_secret_link')}}
                    </a>
                    <p class="mt-4 text-sm text-gray-500">
                        {{__('cta.no_registration')}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div id="faq" class="bg-white flex items-center justify-center px-4 sm:px-16 py-8 sm:py-16">
        <div class="p-4 sm:p-8 w-full max-w-3xl">
            <div class="p-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center mb-8">{{__('faq.title')}}</h2>
                <div class="space-y-6">
                    <!-- FAQ Items -->
                    <details class="border border-gray-200 rounded-lg p-5 cursor-pointer transition hover:shadow-md">
                        <summary class="font-semibold text-gray-700">{{__('faq.security.question')}}?</summary>
                        <p class="text-gray-600 mt-3 leading-relaxed">{{__('faq.security.answer')}}</p>
                    </details>

                    <details class="border border-gray-200 rounded-lg p-5 cursor-pointer transition hover:shadow-md">
                        <summary class="font-semibold text-gray-700">{{__('faq.information_type.question')}}</summary>
                        <p class="text-gray-600 mt-3 leading-relaxed">{{__('faq.information_type.answer')}}</p>
                    </details>

                    <details class="border border-gray-200 rounded-lg p-5 cursor-pointer transition hover:shadow-md">
                        <summary class="font-semibold text-gray-700">{{__('faq.link_expiration.question')}}
                        </summary>
                        <p class="text-gray-600 mt-3 leading-relaxed">{{__('faq.link_expiration.answer')}}</p>
                    </details>

                    <details class="border border-gray-200 rounded-lg p-5 cursor-pointer transition hover:shadow-md">
                        <summary class="font-semibold text-gray-700">{{__('faq.anonymity.question')}}</summary>
                        <p class="text-gray-600 mt-3 leading-relaxed">{{__('faq.anonymity.answer')}}</p>
                    </details>
                </div>
            </div>
        </div>
    </div>

    <!-- Open Source Section -->
    <div id="opensource" class="bg-gray-50 flex items-center justify-center px-4 md:px-24 py-8 md:py-16">
        <div class="p-6 w-full max-w-3xl text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 md:mb-6">{{__('opensource.title')}}</h2>
            <p class="text-gray-600 leading-relaxed mb-6 md:mb-8">{{__('opensource.description')}}</p>
            <a href="https://github.com/gwku/secshare"
               class="inline-block px-4 md:px-6 py-2 md:py-3 bg-teal-400 text-white font-semibold rounded-md shadow hover:bg-teal-500 transition duration-150 ease-in-out"
               target="_blank">
                {{__('github.repository_link.text')}}
            </a>
        </div>
    </div>
@endsection
