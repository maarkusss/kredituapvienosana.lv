@extends('layouts.app')

@section('title', 'Edit a lender - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Edit lender - {{ $lender->name }}</h1>
                </div>
                <form class="w-full p-4 bg-white rounded" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    <div class="flex items-center justify-start h-48 my-4" id="lender-image-container">
                        <img class="object-contain h-full max-w-full max-h-full" src="{{ $lender->image }}" alt="Logo"
                            id="lender_image">
                    </div>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Name</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="name" type="text" value="{{ $lender->name }}" placeholder="Lender's name">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Image link</span>
                            <input
                                class="px-3 py-2 text-xs text-gray-700 bg-gray-100 border border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="image" type="file" accept="image/*" onchange="displayImage(this);"
                                id="fileInput">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Aff link</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="affLink" type="text" value="{{ $lender->affiliate_link }}"
                                placeholder="Lender's affiliate link">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Route name</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="route_name" type="text" value="{{ $lender->route_name }}"
                                placeholder="Lender's route name">
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Display information</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Slogan</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="slogan" type="text" value="{{ $lender_data ? $lender_data->slogan : null }}"
                                placeholder="Lender's slogan">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">First loan</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="firstLoan" type="text" value="{{ $lender->first_loan }}"
                                placeholder="Lender's first loan amount">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Min amount</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="minAmount" type="text" value="{{ $lender->min_amount }}"
                                placeholder="Lender's min loan amount">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max amount</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxAmount" type="text" value="{{ $lender->max_amount }}"
                                placeholder="Lender's max loan amount">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Min term in days</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="minTerm" type="text" value="{{ $lender->min_term }}"
                                placeholder="Lender's min term in days">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max term in days</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxTerm" type="text" value="{{ $lender->max_term }}"
                                placeholder="Lender's max term in days">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Min years</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="minYears" type="text" value="{{ $lender->min_years }}"
                                placeholder="Lender's min years">
                        </label>
                        <label class="flex flex-col w-full5">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max years</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxYears" type="text" value="{{ $lender->max_years }}"
                                placeholder="Lender's max years">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Receiving time in minutes</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="receivingTime" type="text" value="{{ $lender->receiving_time }}"
                                placeholder="Lender's receiving time in minutes">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Meta description</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="meta_description" type="text" value="{{ $lender->meta_description }}"
                                placeholder="Lender's meta description">
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Additional text</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Additional text 1</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="additional_text_1" type="text"
                                value="{{ $lender_data ? $lender->data->additional_text_1 : null }}"
                                placeholder="Lender's additional text 1">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Additional text 2</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="additional_text_2" type="text"
                                value="{{ $lender_data ? $lender->data->additional_text_2 : null }}"
                                placeholder="Lender's additional text 2">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Additional text 3</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="additional_text_3" type="text"
                                value="{{ $lender_data ? $lender->data->additional_text_3 : null }}"
                                placeholder="Lender's additional text 3">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">Additional text 4</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="additional_text_4" type="text"
                                value="{{ $lender_data ? $lender->data->additional_text_4 : null }}"
                                placeholder="Lender's additional text 4">
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Work time</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Work time M - F</span>
                            <input name="work_time_m_f" type="text"
                                value="{{ $lender_data ? $lender_data->work_time_m_f : null }}"
                                placeholder="Work time from Monday to Friday"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Work time Saturday</span>
                            <input name="work_time_sa" type="text"
                                value="{{ $lender_data ? $lender_data->work_time_sa : null }}"
                                placeholder="Work time Saturday"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Work time Sunday</span>
                            <input name="work_time_su" type="text"
                                value="{{ $lender_data ? $lender_data->work_time_su : null }}"
                                placeholder="Work time Sunday"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark">
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">H1, H1 description</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">H1</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="h1" type="text" value="{{ $lender_data ? $lender->data->h1 : null }}"
                                placeholder="Lender's H1">
                        </label>
                        <label class="flex flex-col w-full">
                            <span class="mb-2 text-sm font-medium text-gray-600">H1 description</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="h1_description" type="text"
                                value="{{ $lender_data ? $lender->data->h1_description : null }}"
                                placeholder="Lender's H1 description">
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Categories</h2>
                    <div class="flex flex-wrap mt-2 mb-6 -mx-2 -my-1">
                        @foreach ($languages as $language)
                            <div class="flex flex-col w-1/2 md:w-1/4 lg:flex-1">
                                <span
                                    class="text-base font-semibold text-center text-gray-800">{{ strtoupper($language->value) }}</span>
                                @forelse($categories->where('lang', $language->value) as $category)
                                    <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                        <input
                                            class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                            name="category[{{ $category->id }}]" value="1" type="checkbox"
                                            @if ($lender->categories->where('loan_type_id', $category->id)->first()) checked @endif>
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
                    <h2 class="text-lg font-medium text-gray-700">Information boxes</h2>
                    <div class="flex flex-wrap mt-2 mb-6 -mx-2">
                        <label class="flex flex-col flex-auto w-full mx-2 sm:w-1/3 md:w-1/3 lg:w-1/5">
                            <span class="mb-2 text-sm font-medium text-gray-600">Company's name</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="companysName" type="text"
                                value='{{ $lender_data ? $lender_data->company_name : null }}'
                                placeholder="Lender's company's name">
                        </label>
                        <label class="flex flex-col flex-auto w-full mx-2 mt-3 sm:mt-0 sm:w-1/3 md:w-1/3 lg:w-1/5">
                            <span class="mb-2 text-sm font-medium text-gray-600">Address</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="address" type="text" value="{{ $lender_data ? $lender_data->address : null }}"
                                placeholder="Lender's address">
                        </label>
                        <label class="flex flex-col flex-auto w-full mx-2 mt-3 lg:mt-0 sm:w-1/3 md:w-1/3 lg:w-1/5">
                            <span class="mb-2 text-sm font-medium text-gray-600">Phone</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="phone" type="text" value="{{ $lender_data ? $lender_data->phone : null }}"
                                placeholder="Lender's phone number">
                        </label>
                        <label class="flex flex-col flex-auto w-full mx-2 mt-3 lg:mt-0 sm:w-1/3 md:w-1/3 lg:w-1/5">
                            <span class="mb-2 text-sm font-medium text-gray-600">E-mail</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="email" type="text" value="{{ $lender_data ? $lender_data->email : null }}"
                                placeholder="Lender's e-mail address">
                        </label>
                        <label class="flex flex-col flex-auto w-full mx-2 mt-3 sm:w-1/3 md:w-1/3 lg:w-1/5">
                            <span class="mb-2 text-sm font-medium text-gray-600">Max APR %</span>
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="maxAPR" type="text" value="{{ $lender_data ? $lender_data->max_apr : null }}"
                                placeholder="Lender's max APR percentage">
                        </label>
                        <label class="flex flex-col flex-auto w-full mx-2 mt-3">
                            <span class="mb-2 text-sm font-medium text-gray-600">APR example</span>
                            <textarea name="apr_example" id="editor"
                                class="w-full px-3 py-2 text-gray-800 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                placeholder="Lender's apr_example...">{!! $lender_data ? $lender_data->apr_example : null !!}</textarea>
                        </label>
                        <script>
                            CKEDITOR.replace('apr_example', {
                                scayt_autoStartup: false,
                                enterMode: CKEDITOR.ENTER_BR,
                                forcePasteAsPlainText: true,
                                forceSimpleAmpersand: true,
                                entities: false,
                                basicEntities: false,
                                entities_greek: false,
                                entities_latin: false,
                                toolbarCanCollapse: false,
                            });
                        </script>
                    </div>
                    {{-- <h2 class="text-lg font-medium text-gray-700">Lender's title</h2>
                    <div class="flex flex-wrap mt-2 mb-6 -mx-2">
                        <label class="flex flex-col flex-auto w-full mx-2 sm:w-1/3 md:w-1/3 lg:w-1/5">
                            <input
                                class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                name="lendersTitle" type="text"
                                value="{{ $lender_data ? $lender_data->title : null }}" placeholder="Lender's title">
                        </label>
                    </div> --}}
                    <h2 class="text-lg font-medium text-gray-700">Lender's description</h2>
                    <div class="flex mt-2 mb-6">
                        <label class="w-full">
                            <textarea name="description" id="editor"
                                class="w-full px-3 py-2 text-gray-800 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                placeholder="Lender's description...">{!! $lender_data ? $lender_data->description : null !!}</textarea>
                        </label>
                        <script>
                            CKEDITOR.replace('description', {
                                scayt_autoStartup: false,
                                enterMode: CKEDITOR.ENTER_BR,
                                forcePasteAsPlainText: true,
                                forceSimpleAmpersand: true,
                                entities: false,
                                basicEntities: false,
                                entities_greek: false,
                                entities_latin: false,
                                toolbarCanCollapse: false,
                            });
                        </script>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">0% Lender</h2>
                    <div class="flex mt-2 mb-6">
                        <label class="flex items-center text-gray-700 text-normal">
                            <input type="hidden" name="zero_percent" value="0">
                            <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                name="zero_percent" value="1" type="checkbox"
                                @if ($lender->zero_percent) checked @endif>
                            Enable
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Active</h2>
                    <div class="flex mt-2 mb-6">
                        <label class="flex items-center text-gray-700 text-normal">
                            <input type="hidden" name="active" value="0">
                            <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                name="active" type="checkbox" value="1"
                                @if ($lender->active) checked @endif>
                            Active
                        </label>
                    </div>
                    <div class="flex flex-row justify-end">
                        <button
                            class="flex flex-row items-center order-2 px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
                            type="submit" name="action" value="save">
                            Save
                        </button>
                        <button
                            class="flex flex-row items-center order-1 px-3 py-2 mr-3 text-sm font-medium text-white bg-gray-500 rounded hover:bg-gray-600"
                            type="submit" name="action" value="delete"
                            onclick="return confirm('Are you sure you want to delete this item?');">
                            Delete
                        </button>
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
                    let lenderImage = document.getElementById("lender_image");
                    lenderImage.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
