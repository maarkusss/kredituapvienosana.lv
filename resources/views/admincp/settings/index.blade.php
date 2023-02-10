@extends('layouts.app')

@section('title', 'Settings - ' . env('APP_NAME'))

@section('content')
    @auth
        <div class="flex flex-col w-full min-h-screen pt-16 bg-gray-100 lg:pl-56">
            <!-- Header -->
            @include('admincp.components.header')
        @endauth
        <!-- Main content -->
        <!-- Info box -->
        @include('admincp.components.infobox')
        <!-- End info box -->
        <div class="flex flex-row flex-1 h-full">
            @auth
                <!-- Sidebar -->
                @include('admincp.components.sidebar')
            @endauth
            <!-- Container -->
            <div class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Settings</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                        @if ($logo = \App\Models\Admincp\Settings::where('name', 'logo')->first())
                            <div class="flex items-center justify-start h-12 my-4" id="website-image-container">
                                <img class="object-contain max-w-full max-h-full" id="website-image"
                                    src="{{ $logo->value }}" alt="Website logo">
                            </div>
                        @endif
                        <div class="grid gap-4 mt-2 mb-6 md:grid-cols-2 lg:grid-cols-4">
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Name *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="name" type="text" placeholder="Website's name"
                                    @auth
value="{{ $name->value }}" @endauth required>
                            </label>
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">API KEY *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="api_key" type="text" placeholder="Websites api_key"
                                    @auth
value="{{ $api_key->value }}" @endauth required>
                            </label>
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Individual days EPC *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="individual_days_epc" type="text" placeholder="Websites api_key"
                                    @auth
value="{{ $individual_days_epc->value }}" @endauth required>
                            </label>
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">GoodAff S1 *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="prefix" type="text" placeholder="Goodaff s1 parameter"
                                    @auth
value="{{ $prefix->value }}" @endauth required>
                            </label>
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Logo</span>
                                <input
                                    class="px-3 py-2 text-xs text-gray-700 bg-gray-100 border border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="logo" type="file" accept="image/*" onchange="displayImage(this);"
                                    id="fileInput">
                            </label>
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Sitemap Crawler link *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="sitemap" type="url" placeholder="Sitemap crawler link"
                                    @auth
value="{{ $sitemap->value }}" @endauth required>
                            </label>
                            <label class="flex flex-col flex-auto w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Country code *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                    name="country_code" type="text" placeholder="Country code"
                                    @auth
value="{{ $country_code->value }}" @endauth required>
                            </label>
                        </div>
                        <label class="flex flex-col flex-auto w-full mb-6">
                            <span class="mb-2 text-sm font-medium text-gray-600">Head code</span>
                            <textarea class="w-full bg-gray-100 border border-gray-300 rounded resize-y focus:ring-primary-dark" name="head_code"
                                cols="30" rows="10">@auth @if ($head_code)
{{ $head_code->value }}
@endif @endauth
</textarea>
                        </label>
                        <div class="grid gap-4 mb-6 md:grid-cols-2 lg:grid-cols-4">
                            <div class="flex flex-col w-full">
                                <h2 class="mb-2 text-lg font-medium text-gray-700">Language selection</h2>
                                <label class="flex items-center my-1 text-gray-700 text-normal">
                                    <input name="lang['lv']" value="lv" type="checkbox"
                                        class="mr-2 border-gray-300 rounded form-checkbox text-primary-normal focus:ring-primary-dark"
                                        @auth @if ($lang->where('value', 'lv')->first()) checked @endif @endauth>
                                    Latvia
                                </label>
                                <label class="flex items-center my-1 text-gray-700 text-normal">
                                    <input name="lang['ru']" value="ru" type="checkbox"
                                        class="mr-2 border-gray-300 rounded form-checkbox text-primary-normal focus:ring-primary-dark"
                                        @auth @if ($lang->where('value', 'ru')->first()) checked @endif @endauth>
                                    Russia
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-row justify-end">
                            <button
                                class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
                                type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-settings");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        function displayImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let lenderImage = document.getElementById("website-image");
                    let lenderImageContainer = document.getElementById("website-image-container");
                    lenderImage.src = e.target.result;
                    lenderImage.alt = "Logo";
                    lenderImageContainer.classList.add("h-48");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
