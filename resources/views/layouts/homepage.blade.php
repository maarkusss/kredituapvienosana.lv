<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <meta property="og:url"
          content="{{ request()->url() }}">
    <title>@yield('title')</title>
    <meta property="og:title"
          content="@yield('title')">
    <meta name="description"
          content="@yield('description')">
    <meta property="og:description"
          content="@yield('description')">
    <meta property="og:image"
          content="{{ asset('images/icon-192x192.png') }}">
    <meta name="keywords"
          content="@yield('keywords')">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <link rel="shortcut icon"
          href="/favicon.png">
    <link href="{{ mix('css/app.css') }}"
          rel="stylesheet">
    @if (\App\Models\Admincp\Settings::where('name', 'head_code')->exists())
        {!! \App\Models\Admincp\Settings::where('name', 'head_code')->first()->value !!}
    @endif
    <!-- Schema start -->
    @yield('schema')
    <!-- Schema end -->
    <link rel="preload"
          href="/images/calculator-pencil.webp"
          as="image"
          type="image/webp">
    <link rel="preload"
          href="/images/dark_tint.webp"
          as="image"
          type="image/webp">
</head>

<body class="antialiased text-gray-700 bg-white font-helvetica">
    @include('components.navbar')
    @yield('content')
    <x-scroll-to-top-button />
    @include('components.footer')
    @include('components.cookies-notification')
    {{-- Scripts --}}
    @yield('javascript')

</body>

</html>
