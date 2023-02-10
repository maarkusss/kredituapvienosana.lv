@extends('layouts.homepage')

@section('title', $section->title . ' - ' . env('APP_NAME'))
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
    <main class="max-w-6xl mx-auto">
        <section class="max-w-6xl px-4 mx-auto">
            <div class="pt-12">
                <h1 class="pb-2 text-4xl font-semibold text-center text-gray-800">{{ $section->h1 }}</h1>
                <h1 class="text-xl text-center text-gray-500">{{ $section->h1_description }}</h1>
            </div>
        </section>

        {{-- Section source text --}}
        @if (isset($section->source))
            <section class="max-w-6xl px-4 pt-6 mx-auto">
                <div class="max-w-full prose text-justify text-gray-800">
                    {!! $section->source !!}
                </div>
            </section>
        @endif

        {{-- Show all active lenders --}}
        @if (count($lenders) > 0)
            <section class="max-w-6xl px-4 py-12 mx-auto">
                <div class="p-12 border border-gray-100 rounded-md shadow-md">
                    <div class="grid grid-cols-1 gap-6 pb-2 mx-auto md:grid-cols-6">
                        @foreach ($lenders as $lender)
                            <a class="transition-all duration-200 hover:translate-y-2 hover:drop-shadow-xl"
                               href="{{ route('section.deep', ['name' => $section->route_name, 'deep_name' => $lender->route_name]) }}">
                                <img src="{{ $lender->image }}"
                                     alt="{{ $lender->name }}"
                                     title="{{ $lender->name }}"
                                     loading="lazy">
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Section text --}}
        @if (isset($section->text))
            <section class="max-w-6xl px-4 pb-12 mx-auto">
                <div class="max-w-full prose text-justify text-gray-800">
                    {!! $section->text !!}
                </div>
            </section>
        @endif

        {{-- FAQ --}}
        @if ($section->type == 'faqs')
            @if ($faqs)
                <x-faq :faqs="$faqs"
                       :faqPage="true"></x-faq>
            @endif
        @endif
    </main>
    {{-- <main>
        <section class="bg-no-repeat bg-cover bg-banner py-44">
            <div class="px-4 mx-auto text-white max-w-screen-2xl">
                <h1 class="pb-2 text-5xl text-center">
                    {{ $section->name }}
                </h1>
                <h2 class="mb-8 text-xl text-center">
                    {{ $section->source }}
                </h2>
            </div>
        </section>
        @if (count($lenders) > 0)
            <section class="-translate-y-40 bg-transperent">
                <div class="relative px-4 mx-auto md:px-32 max-w-screen-2xl">
                    <div class="p-12 bg-white rounded-md">
                        <div class="grid grid-cols-1 gap-6 pb-2 mx-auto md:grid-cols-6">
                            @foreach ($lenders as $lender)
                                <a
                                    href="{{ route('section.deep', ['name' => $section->route_name, 'deep_name' => $lender->route_name]) }}">
                                    <img src="{{ $lender->image }}" alt="{{ $lender->name }}" title="{{ $lender->name }}"
                                        loading="lazy">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="py-20 bg-background-normal">
        </section>
    </main> --}}
@endsection
