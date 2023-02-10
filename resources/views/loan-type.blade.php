@extends('layouts.homepage')

@section('title', $loanType->title . __('в') . date('Y') . __('gadā'))
@section('description', $loanType->description)
@section('keywords', $loanType->keywords)
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
    <main>
        <section class="max-w-6xl px-4 mx-auto">
            <div class="pt-12">
                <h1 class="pb-2 text-4xl font-semibold text-center text-gray-800">{{ $loanType->h1 }}</h1>
                <p class="pb-4 text-xl text-center text-gray-500">{{ $loanType->h1_description }}</p>
            </div>
        </section>
        @if (count($lenders) > 0)
            <section>
                <div class="relative max-w-screen-xl px-4 mx-auto lg:px-8">
                    <div class="p-2 bg-white rounded-md xl:p-10">
                        <div class="grid grid-cols-1 gap-2 pb-2 mx-auto md:pb-8 md:gap-4 md:grid-cols-1">
                            <!-- Loan box -->
                            @foreach ($lenders as $position => $lender)
                                @component('components.offer-box',
                                    [
                                        'lender' => $lender,
                                        'position' => $position,
                                        'loop' => $loop,
                                        'reviewSection' => $reviewSection,
                                        'reviews' => $reviews,
                                    ])
                                @endcomponent
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if ($loanType->text)
            <section class="max-w-6xl pb-12 mx-auto">
                <div class="flex flex-col md:flex-row">
                    <div class="max-w-full px-4 mx-auto prose text-gray-800">
                        {!! $loanType->text !!}
                    </div>
                </div>
            </section>
        @endif
        {{-- FAQ --}}
        @if (count($loanType->faqs()) > 0)
            <x-faq :faqs="$loanType->faqs()"
                   :faqPage="false"></x-faq>
            @php
                $faqsection = \App\Models\Admincp\Sections\Sections::where('type', 'faqs')
                    ->where('lang', app()->getLocale())
                    ->where('active', 1)
                    ->first();
            @endphp
            @if ($faqsection)
                <div class="flex items-center justify-center pb-12">
                    <a href="{{ route('section', ['name' => $faqsection->route_name]) }}"
                       class="px-4 py-2 font-semibold text-center text-white transition-colors border bg-primary-normal rounded-xl border-primary-normal hover:bg-white hover:text-primary-normal">@lang('More')</a>
                </div>
            @endif
        @endif
    </main>
@endsection
