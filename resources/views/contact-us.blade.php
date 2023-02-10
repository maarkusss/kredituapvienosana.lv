@extends('layouts.homepage')
@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', $section->title)
@endif
@section('description', $section->description)
@section('keywords', $section->keywords)
@section('schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "@yield('title')",
            "description": "@yield('description')",
            "url": "{{ url()->current() }}",
            "logo": "
            @if ($logo = \App\Models\Admincp\Settings::where('name', 'logo')->first())
                {{ 'https://kredituapvienosana.lv' . $logo->value }}
            @endif
            ",
            "image": "https://kredituapvienosana.lv/images/icon-192x192.png",
            "email": "mailto:info@kredituapvienosana.lv",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Saldus",
                "postalCode": "3801",
                "streetAddress": "Liela iela 9",
                "addressCountry": "LV"
            }
        }
    </script>
@endsection
@section('content')
    <main class="bg-primary-bg">
        <div class="max-w-screen-xl px-4 py-5 mx-auto md:px-16">
            <div class="text-base text-gray-800">
                <h1 class="pt-5 mb-6 text-4xl font-semibold text-center">
                    {{ $section->name }}
                </h1>
                <div class="max-w-full mb-2 prose text-center">
                    {!! $section->source !!}
                </div>
                <div class="max-w-full mb-2 prose text-justify">
                    {!! $section->text !!}
                </div>
                <form action="{{ route('section.post', ['name' => $section->route_name]) }}"
                      method="POST">
                    @csrf
                    <input type="hidden"
                           id="recaptchaResponse"
                           name="recaptcha">
                    <label class="block mb-2">
                        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-300 focus:ring-blue-300 focus:drop-shadow-lg"
                               type="text"
                               name="name"
                               placeholder="@lang('Name')" />
                    </label>
                    <label class="block mb-2">
                        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-300 focus:ring-blue-300 focus:drop-shadow-lg"
                               type="email"
                               name="email"
                               placeholder="@lang('E-mail')"
                               required />
                    </label>
                    <label class="block mb-2">
                        <textarea rows="7"
                                  class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-300 focus:ring-blue-300 focus:drop-shadow-lg"
                                  name="question"
                                  placeholder="@lang('Your question')"
                                  required></textarea>
                    </label>
                    <div class="flex flex-row items-center">
                        <button class="px-3 py-2 text-center text-white transition-all rounded-md bg-primary-button hover:bg-blue-600"
                                type="submit">
                            @lang('Send a message')
                        </button>
                        @include('components.infobox')
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://www.google.com/recaptcha/api.js?render=6LeX0AohAAAAAILSMvrmwVP7rKZJ7UgveLgM5t0f"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeX0AohAAAAAILSMvrmwVP7rKZJ7UgveLgM5t0f', {
                action: 'homepage'
            }).then(function(token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
@endsection
