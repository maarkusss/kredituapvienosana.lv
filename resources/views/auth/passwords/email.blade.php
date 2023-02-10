@extends('layouts.app')

@section('title', 'Password reset link - ' . env('APP_NAME'))

@section('content')
    <div class="flex flex-col items-center justify-center w-full min-h-screen p-4 bg-gray-100">
        <div class="flex flex-row items-center justify-center mb-4">
            @if ($logo = \App\Models\Admincp\Settings::where('name', 'logo')->first())
                <div class="w-64">
                    <img src="{{ $logo->value }}"
                         alt="Logo"
                         class="h-auto max-w-full">
                </div>
            @else
                <svg width="30"
                     height="30">
                    <path d="M1.00505 13.1371C-0.335017 11.797 -0.335017 9.62434 1.00505 8.28427L8.28427 1.00505C9.62434 -0.335017 11.797 -0.335017 13.1371 1.00505L20.4163 8.28427C21.7564 9.62434 21.7564 11.797 20.4163 13.1371L13.1371 20.4163C11.797 21.7564 9.62434 21.7564 8.28427 20.4163L1.00505 13.1371Z"
                          fill="#2F70E8"
                          fill-opacity="0.5" />
                    <path d="M9.58369 13.1371C8.24363 11.797 8.24363 9.62434 9.58369 8.28427L16.8629 1.00505C18.203 -0.335017 20.3757 -0.335017 21.7157 1.00505L28.9949 8.28427C30.335 9.62434 30.335 11.797 28.9949 13.1371L21.7157 20.4163C20.3757 21.7564 18.203 21.7564 16.8629 20.4163L9.58369 13.1371Z"
                          fill="#2F70E8"
                          fill-opacity="0.5" />
                    <path d="M1.00505 21.7157C-0.335017 20.3757 -0.335017 18.203 1.00505 16.8629L8.28427 9.58369C9.62434 8.24363 11.797 8.24363 13.1371 9.58369L20.4163 16.8629C21.7564 18.203 21.7564 20.3757 20.4163 21.7157L13.1371 28.9949C11.797 30.335 9.62434 30.335 8.28427 28.9949L1.00505 21.7157Z"
                          fill="#2F70E8"
                          fill-opacity="0.5" />
                    <path d="M9.58369 21.7157C8.24363 20.3757 8.24363 18.203 9.58369 16.8629L16.8629 9.58369C18.203 8.24363 20.3757 8.24363 21.7157 9.58369L28.9949 16.8629C30.335 18.203 30.335 20.3757 28.9949 21.7157L21.7157 28.9949C20.3757 30.335 18.203 30.335 16.8629 28.9949L9.58369 21.7157Z"
                          fill="#2F70E8"
                          fill-opacity="0.5" />
                </svg>
                <span class="ml-3 text-2xl font-bold text-primary-normal">SomeLogo</span>
            @endif
        </div>
        @if ($errors->any())
            <div class="flex items-center justify-start p-3 mb-4 bg-red-200 border border-red-800 rounded">
                <span class="text-sm font-medium text-red-800">{{ $errors->first() }}</span>
            </div>
        @endif
        @if (session('status'))
            <div class="flex items-center justify-start p-3 mb-4 bg-green-200 border border-green-800 rounded"
                 role="alert">
                <span class="text-sm font-medium text-green-800">{{ session('status') }}</span>
            </div>
        @endif
        <div class="flex flex-col items-center justify-center w-full p-4 bg-white rounded sm:w-auto">
            <h1 class="mb-4 text-2xl font-medium text-gray-700">{{ __('Reset password') }}</h1>
            <form method="POST"
                  action="{{ route('password.email') }}"
                  class="w-full sm:w-auto">
                @csrf
                <div>
                    <label class="flex flex-col">
                        <span class="mb-2 text-sm font-medium text-gray-600">{{ __('E-mail address') }}</span>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               class="w-full px-3 py-2 text-gray-700 bg-gray-200 border rounded appearance-none sm:w-64">
                    </label>
                </div>
                <button type="submit"
                        class="w-full px-3 py-2 mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded hover:bg-gray-800">
                    {{ __('Send password reset link') }}
                </button>
            </form>
        </div>
    </div>
@endsection
