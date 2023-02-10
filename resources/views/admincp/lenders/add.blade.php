@extends('layouts.app')

@section('title', 'Add a lender - ' . env('APP_NAME'))

@section('content')
    <div class="flex flex-col w-full min-h-screen pt-16 bg-gray-100 lg:pl-56">
        <!-- Header -->
        @include('admincp.components.header')
        <!-- Main content -->
        <!-- Info box -->
        @include('admincp.components.infobox')
        <!-- End info box -->
        <div class="flex flex-row flex-auto h-full">
            <!-- Sidebar -->
            @include('admincp.components.sidebar')
            <!-- Container -->
            <div class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Add a new lender</h1>
                </div>
                <form method="POST" class="w-full p-4 bg-white rounded" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    <div class="flex items-center justify-start my-4" id="lender-image-container">
                        <img class="object-contain max-w-full max-h-full" alt="Lender image" id="lender-image">
                    </div>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600 ">
                                Name *
                            </span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="name" type="text" placeholder="Lender's name" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Image *</span>
                            <input
                                class="px-3 py-2 text-xs text-gray-700 bg-gray-100 border border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="image" type="file" accept="image/*" onchange="displayImage(this);" id="fileInput"
                                required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Aff link *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="affLink" type="text" placeholder="Lender's affiliate link" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Route name</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="route_name" type="text" placeholder="Lender's route name" required>
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Display information</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Slogan *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="slogan" type="text" placeholder="Lender's slogan" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">First loan *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="firstLoan" type="text" placeholder="Lender's first loan amount">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Min amount *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="minAmount" type="text" placeholder="Lender's min loan amount" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max amount *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxAmount" type="text" placeholder="Lender's max loan amount" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Min term in days *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="minTerm" type="text" placeholder="Lender's min term in days" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max term in days *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxTerm" type="text" placeholder="Lender's max term in days" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Min years *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="minYears" type="text" placeholder="Lender's min years" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max years *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxYears" type="text" placeholder="Lender's max years" required>
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Receiving time in minutes *</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="receivingTime" type="text" placeholder="Lender's receiving time in minutes"
                                required>
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Categories</h2>
                    <div class="flex flex-wrap mt-2 mb-6 -mx-2 -my-">
                        @foreach ($languages as $language)
                            <div class="flex flex-col w-1/2 md:w-1/4 lg:flex-1">
                                <span
                                    class="text-base font-semibold text-center text-gray-800">{{ strtoupper($language->value) }}</span>
                                @forelse($categories->where('lang', $language->value) as $category)
                                    <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                        <input
                                            class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                            name="category[{{ $category->id }}]" value="1" type="checkbox">
                                        {{ $category->name }}
                                    </label>
                                @empty
                                    <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                        No loan types on this language
                                    </label>
                                @endforelse
                            </div>
                        @endforeach
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">0% Lender</h2>
                    <div class="flex mt-2 mb-6">
                        <label class="flex items-center text-gray-700 text-normal">
                            <input type="hidden" name="zero_percent" value="0">
                            <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                name="zero_percent" value="1" type="checkbox">
                            Enable
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Active</h2>
                    <div class="flex mt-2 mb-6">
                        <label class="flex items-center text-gray-700 text-normal">
                            <input type="hidden" name="active" value="0">
                            <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                name="active" value="1" type="checkbox">
                            Active
                        </label>
                    </div>
                    <div class="flex flex-row justify-end">
                        <a href="{{ route('admincp.lenders.index') }}">
                            <button type="submit"
                                class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark">
                                Add
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-lenders");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        function displayImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let lenderImage = document.getElementById("lender-image");
                    let lenderImageContainer = document.getElementById("lender-image-container");
                    lenderImage.src = e.target.result;
                    lenderImage.alt = "Logo";
                    lenderImageContainer.classList.add("h-48");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
