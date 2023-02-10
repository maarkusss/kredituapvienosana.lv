@extends('layouts.homepage')

@section('title', $section->title . ' | ' . env('APP_NAME'))
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
    <main>
        @if (isset($section->title))
            <section class="py-12">
                <div class="px-4 mx-auto text-gray-800 max-w-screen-2xl">
                    <h1 class="pt-2 pb-2 text-4xl font-semibold text-center">
                        {{ $section->title }}
                    </h1>
                    @if (isset($section->source))
                        <h1 class="pt-2 pb-2 text-xl text-center text-gray-500">
                            {!! $section->source !!}
                        </h1>
                    @endif
                </div>
            </section>
        @endif
        <section class="pb-12">
            @if (count($blogPosts) > 0)
                <div class="max-w-screen-xl px-4 mx-auto">
                    <div class="grid gap-2.5 bg-white rounded-md lg:p-12 p-4">
                        @foreach ($blogPosts as $blogPost)
                            <div class="flex flex-col pb-6 border-b">
                                <div class="grid grid-cols-1 gap-4 text-justify lg:grid-cols-2">
                                    <a href="{{ route('section.deep', ['name' => $section->route_name, 'deep_name' => $blogPost->route_name]) }}"
                                       title="{{ $blogPost->name }}">
                                        <div class="flex items-center justify-center">
                                            <img class="object-contain max-w-full max-h-96 rounded-xl"
                                                 src="{{ $blogPost->image }}"
                                                 alt="{{ $blogPost->image_alt_text }}"
                                                 loading="lazy"
                                                 title="{{ $blogPost->image_alt_text }}">
                                        </div>
                                    </a>
                                    <div class="flex flex-col items-center justify-between">
                                        <a class="inline-block group hover:underline"
                                           href="{{ route('section.deep', ['name' => $section->route_name, 'deep_name' => $blogPost->route_name]) }}"
                                           title="{{ $blogPost->name }}">
                                            <p class="px-4 text-2xl font-semibold text-center text-gray-700">
                                                {{ $blogPost->name }}
                                            </p>
                                        </a>
                                        <span class="pb-4 text-sm text-right text-gray-500 group-hover:text-primary-dark group-hover:underline">
                                            {{ date('Y-m-d', strtotime($blogPost->created_at)) }}
                                        </span>
                                        <div class="max-w-full mb-4 prose text-left text-md lg:line-clamp-4 line-clamp-2 md:mb-0">
                                            {!! $blogPost->source !!}
                                        </div>
                                        <div class="bottom-0 pb-4 mt-auto text-center">
                                            <a class="group inline-block text-sm bg-primary-normal rounded-xl py-2.5 px-3.5 text-white hover:bg-opacity-80 transition-all"
                                               href="{{ route('section.deep', ['name' => $section->route_name, 'deep_name' => $blogPost->route_name]) }}"
                                               title="{{ $blogPost->name }}">
                                                @lang('More')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        {{ $blogPosts->links('components.pagination') }}
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
