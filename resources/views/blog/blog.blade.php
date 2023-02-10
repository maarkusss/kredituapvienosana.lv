@extends('layouts.homepage')

@section('title', $blogPost->title . ' | ' . env('APP_NAME'))
@section('description', $blogPost->description)
@section('keywords', $blogPost->keywords)
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
        <section class="py-12">
            <div class="max-w-screen-xl px-4 mx-auto text-gray-800">
                <p class="pb-2 text-4xl font-semibold text-center">
                    {{ $blogPostParent->name }}
                </p>
            </div>
        </section>
        <section class="pb-12">
            <div class="max-w-screen-xl px-4 mx-auto md:px-20">
                <div class="grid gap-2.5 bg-white rounded-md">
                    <h1 class="text-xl font-bold text-center lg:text-3xl">
                        {{ $blogPost->name }}
                    </h1>
                    <div class="max-w-full prose prose-p:text-gray-600">
                        <div class="flex items-center justify-center">
                            <img class="object-contain max-w-full max-h-96 rounded-xl"
                                 src="{{ $blogPost->image }}"
                                 alt="{{ $blogPost->image_alt_text }}"
                                 loading="lazy"
                                 title="{{ $blogPost->image_alt_text }}">
                        </div>
                        {!! $blogPost->text !!}
                    </div>
                    <div class="flex items-center justify-between py-4 mb-4">
                        <div class="pl-4">
                            <button class="p-1 mx-1 text-white transition-all duration-200 rounded-full bg-primary-normal hover:bg-primary-dark hover:shadow-lg"
                                    type="button"
                                    onclick="shareFacebook('{{ request()->url() }}');">
                                <svg class="w-6 h-6 fill-current"
                                     viewBox="0 0 24 24">
                                    <path d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z" />
                                </svg>
                            </button>
                            <button class="p-1 mx-1 text-white transition-all duration-200 rounded-full bg-primary-normal hover:bg-primary-dark hover:shadow-lg"
                                    type="button"
                                    onclick="shareTwitter('{{ request()->url() }}', '{{ $blogPost->name }}');">
                                <svg class="w-6 h-6 fill-current"
                                     viewBox="0 0 24 24">
                                    <path d="M22 5.8a8.49 8.49 0 0 1-2.36.64 4.13 4.13 0 0 0 1.81-2.27 8.21 8.21 0 0 1-2.61 1 4.1 4.1 0 0 0-7 3.74 11.64 11.64 0 0 1-8.45-4.29 4.16 4.16 0 0 0-.55 2.07 4.09 4.09 0 0 0 1.82 3.41 4.05 4.05 0 0 1-1.86-.51v.05a4.1 4.1 0 0 0 3.3 4 3.93 3.93 0 0 1-1.1.17 4.9 4.9 0 0 1-.77-.07 4.11 4.11 0 0 0 3.83 2.84A8.22 8.22 0 0 1 3 18.34a7.93 7.93 0 0 1-1-.06 11.57 11.57 0 0 0 6.29 1.85A11.59 11.59 0 0 0 20 8.45v-.53a8.43 8.43 0 0 0 2-2.12Z" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <span class="pb-4 pr-4 text-sm text-right text-gray-500 group-hover:text-primary-dark group-hover:underline">
                                {{ date('Y-m-d', strtotime($blogPost->created_at)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
<script>
    function shareFacebook(url) {
        window.open(`https://www.facebook.com/sharer.php?u=${url}`, "Facebook",
            "width=500, height=350, menubar=false, resizable=true");
    };

    function shareTwitter(url, blogName) {
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${blogName}`, "Twitter",
            "width=500, height=350, menubar=false, resizable=true");
    };
</script>
