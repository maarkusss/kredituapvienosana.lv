@extends('layouts.homepage')

@section('title', __('Not Found'))

@section('content')
    <main class="flex items-center justify-center min-h-screen px-4 py-8 lg:px-0">
        <div class="text-center">
            <h1 class="block text-4xl font-medium text-primary-normal">{{ __('429 | Too many requests') }}</h1>
            <span class="block text-sm font-normal text-gray-800">{{ __('Oops.. You ended up too far! 🚀') }}</span>
            <a href="{{ route('homepage') }}"
                class="mt-8 px-3 py-2 bg-primary-normal text-sm font-medium text-black rounded hover:bg-{{ $color }}_hover block">{{ __('Take me back!') }}</a>
        </div>
    </main>
@endsection
