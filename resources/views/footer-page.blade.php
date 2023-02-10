@extends('layouts.homepage')

@section('title', $section->title)
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
                <p class="text-xl text-center text-gray-500">{{ $section->h1_description }}</p>
            </div>
        </section>
        <section class="max-w-6xl px-4 pt-6 pb-12 mx-auto">
            <div class="max-w-full prose text-justify text-gray-800">
                {!! $section->text !!}
            </div>
        </section>
        {{-- FAQ --}}
        @if ($section->type == 'faqs')
            @if ($faqs)
                <x-faq :faqs="$faqs"
                       :faqPage="true"></x-faq>
            @endif
        @endif
    </main>
@endsection
