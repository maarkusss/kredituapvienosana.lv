@extends('layouts.offers')
@section('title', __('Отказ от новостей') . env('APP_NAME'))
@section('description', 'Description')
@section('keywords', 'Keywords')
@section('content')
    @include('admincp.components.infobox')
    <main class="flex items-start justify-center max-w-screen-sm px-4 py-8 mx-auto">
        <div class="text-center">
            <h1 class="text-2xl font-semibold leading-none text-gray-800">
                @lang('Отказ от новостей и актуальной информации')
            </h1>
            <p class="mt-4 text-base font-normal leading-tight text-gray-600">
                @lang('Нажав кнопку «Отказаться» Ты безвозвратно откажешься от получения новостей на свою мобильного телефону и э-почту')
            </p>
            <form method="POST">
                @csrf
                <div class="flex items-center w-full mt-4 bg-white border rounded">
                    <span
                        class="flex-shrink-0 px-4 py-3 text-base font-semibold text-gray-700 border-r select-none">+380</span>
                    <label class="w-full">
                        <input required id="phone" name="phone" type="text" inputmode="tel" pattern="[0-9]*"
                            placeholder="@lang('Ваш номер телефона')" minlength="9" maxlength="9"
                            class="w-full px-4 py-3 rounded appearance-none focus:outline-none focus:shadow-outline">
                    </label>
                </div>
                <button type="submit"
                    class="w-full px-4 py-3 mt-4 text-lg font-semibold text-center text-gray-800 transition-all duration-200 rounded bg-primary-normal hover:bg-primary-dark focus:outline-none focus:shadow-outline">
                    @lang('Отказаться')
                </button>
            </form>
        </div>
    </main>
    <footer class="py-8">
        <div class="flex flex-col items-center justify-center px-4 text-center">
            <a href="{{ route('homepage') }}">
                @if ($logo = \App\Models\Admincp\Settings::where('name', 'logo')->first())
                    <img src="{{ $logo->value }}" alt="Logo" class="w-auto h-6">
                @endif
            </a>
            <span class="mt-4 text-base font-normal leading-none text-gray-800">© 2020 - {{ date('Y') }}</span>
        </div>
    </footer>
@endsection
