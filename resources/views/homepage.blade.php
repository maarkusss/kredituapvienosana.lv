@extends('layouts.homepage')

@section('title', $homepage->title)
@section('description', $homepage->description)
@section('keywords', $homepage->keywords)
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
        <section class="bg-no-repeat bg-cover calculator">
            <div class="bg-no-repeat bg-cover darktint">
                <div class="max-w-full mx-auto py-[12.25vh]">
                    <div class="px-2 pb-8">
                        <h1 class="pb-4 pt-[7rem] text-4xl font-semibold text-center text-white">{{ $homepage->h1 }}</h1>
                        <p class="text-lg font-light text-center text-white">{{ $homepage->h1_description }}</p>
                    </div>
                    @if ($loanTypes)
                        <div class="flex items-center justify-center pb-40">
                            <a class="px-4 py-1.5 drop-shadow-lg text-white bg-primary-button hover:bg-blue-600 transition-all duration-200 rounded-md w-max"
                               href="{{ route('section', ['name' => $loanTypes->route_name]) }}"
                               title="{{ $loanTypes->name }}">
                                @lang('Apvieno kredītus')
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="pb-12">
            <div class="max-w-full px-2 mx-auto">
                <div class="max-w-full py-10 prose text-center">
                    {!! $homepage->source !!}
                </div>
            </div>
            <div class="flex items-center justify-center max-w-6xl px-4 mx-auto">
                <div class="grid grid-cols-1 gap-2 md:gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @if (count($homepage->children) > 0)
                        @foreach ($homepage->children as $children)
                            <div class="px-6 pt-8 pb-12 bg-white border drop-shadow-xl border-primary-normal border-opacity-5">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="max-w-full prose-xs">
                                        {!! $children->source !!}</div>
                                </div>
                                <h3 class="text-lg font-semibold text-center py-3.5">{{ $children->name }}</h3>
                                <ul>
                                    <div class="flex flex-col items-center justify-center mt-auto">
                                        <div class="max-w-full prose-xs prose-ul:list-disc prose-ul:pl-10">
                                            {!! $children->text !!}</div>
                                        @if ($children->image)
                                            <img class="w-full h-full pt-2.5"
                                                 src="{{ $children->image }}"
                                                 alt="{{ $children->image_alt_text }}"
                                                 loading="lazy"
                                                 title="{{ $children->image_alt_text }}">
                                        @endif
                                    </div>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @if ($homepage->text)
                <section class="max-w-6xl px-4 pt-12 mx-auto">
                    <div class="max-w-full prose">
                        {!! $homepage->text !!}
                    </div>
                </section>
            @endif
            @if ($loanTypes)
                <div class="flex items-center justify-center pt-12">
                    <a class="px-4 py-1.5 drop-shadow-lg text-white bg-primary-button hover:bg-blue-600 transition-all duration-200 rounded-md w-max"
                       href="{{ route('section', ['name' => $loanTypes->route_name]) }}"
                       title="{{ $loanTypes->name }}">
                        @lang('Read more')
                    </a>
                </div>
            @endif
        </section>
        {{-- FAQ --}}
        {{-- @if (count($faqs) > 0) --}}
        {{-- <x-faq :faqs="$faqs" :faqPage="true"></x-faq> --}}
        {{-- @endif --}}

    </main>
@endsection
<script>
    function testWebPSupport() {
        return new Promise((resolve) => {
            const webp = "data:image/webp;base64,UklGRkAAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAIAAAAAAFZQOCAYAAAAMAEAnQEqAQABAAFAJiWkAANwAP79NmgA";
            const test_img = new Image();
            test_img.src = webp;
            test_img.onerror = e => resolve(false);
            test_img.onload = e => resolve(true);
        });
    }

    (async () => {

        const supports_webp = await testWebPSupport();

        // for inline ones, just check the value of supports_webp
        const extension = supports_webp ? 'webp' : 'jpg';
        if (!supports_webp) {
            document.body.classList.add('no-webp');
        }
    })();
</script>
