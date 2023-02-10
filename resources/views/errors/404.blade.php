@extends('layouts.homepage')

@section('title', __('Not Found'))

@section('content')
    <main class="flex items-center justify-center min-h-screen px-4 py-8 lg:px-0">
        <div class="text-center">
            <h1 class="block text-4xl font-medium text-primary-normal">{{ __('404 | Not Found') }}</h1>
            <span class="block text-sm font-normal text-gray-800">{{ __('Oops.. You ended up too far! 🚀') }}</span>
            <a href="{{ route('homepage') }}"
                class="block px-3 py-2 mt-8 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-normal_hover">{{ __('Take me back!') }}</a>

        </div>
    </main>
@endsection
