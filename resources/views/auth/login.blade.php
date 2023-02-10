@extends('layouts.app')

@section('title', 'Login - ' . env('APP_NAME'))

@section('content')
    <div class="flex flex-col items-center justify-center w-full min-h-screen p-4 bg-gray-100">
        @if ($errors->any())
            <div class="flex items-center justify-start p-3 mb-4 bg-red-200 border border-red-800 rounded">
                <span class="text-sm font-medium text-red-800">{{ $errors->first() }}</span>
            </div>
        @endif
        <div
            class="flex flex-col items-center justify-center w-full sm:w-auto p-8 bg-white rounded-xl border border-primary-normal">
            <h1 class="mb-4 text-2xl font-medium text-gray-700">{{ __('Login') }}</h1>
            <form method="POST" action="{{ route('login') }}" class="w-full sm:w-auto">
                @csrf
                <div>
                    <label class="flex flex-col mb-3">
                        <span class="mb-2 text-sm font-medium text-gray-600">{{ __('Username') }}</span>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required
                            autocomplete="email"
                            class="w-full px-3 py-2 text-gray-700 bg-gray-200 border rounded appearance-none sm:w-64">
                    </label>
                </div>
                <div>
                    <label class="flex flex-col mb-3">
                        <span class="mb-2 text-sm font-medium text-gray-600">{{ __('Password') }}</span>
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                            class="w-full px-3 py-2 text-gray-700 bg-gray-200 border rounded appearance-none sm:w-64">
                    </label>
                </div>
                <div>
                    <label class="flex items-center text-sm font-medium text-gray-600">
                        <input type="checkbox" name="remember" id="remember" class="mr-2 rounded text-primary-normal"
                            {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember me') }}
                    </label>
                </div>
                <button type="submit"
                    class="w-full px-3 py-2 mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded hover:bg-gray-800">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <div class="w-full mt-3 text-center">
                        <a href="{{ route('password.request') }}">
                            <span
                                class="text-sm font-medium text-gray-600 hover:text-gray-700 hover:underline">{{ __('Forgot your password?') }}</span>
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
