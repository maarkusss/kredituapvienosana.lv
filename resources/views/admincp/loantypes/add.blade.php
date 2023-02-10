@extends('layouts.app')

@section('title', 'Add a loan type - ' . env('APP_NAME'))

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
            <form action={{ route('admincp.loantypes.store') }} method="POST"
                class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent"
                enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Add a loan type</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    <div class="flex items-center justify-start my-4" id="lender-image-container">
                        <img id="lender-image" class="object-contain max-w-full max-h-full">
                    </div>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Type</span>
                            <select name="type" id="type"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none form-select">
                                <option value="0">Select a type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Name</span>
                            <input name="name" type="text" placeholder="Loan type's name"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Routing name *</span>
                            <input name="route_name" type="text" placeholder="Loan type's link"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Title *</span>
                            <input name="title" type="text" placeholder="Loan type's title"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Description</span>
                            <input name="description" type="text" placeholder="Loan type's description"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Google keywords</span>
                            <input name="keywords" type="text" placeholder="Loan type's Google keywords"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none">
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Anchor element title</span>
                            <input name="anchor_element_title" type="text" placeholder="Loantype anchor element's title"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none" maxlength="191">
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">H1, H1 description</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">H1</span>
                            <input name="h1" type="text" placeholder="Loan type's H1"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none" maxlength="191"
                                autocomplete="off" />
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">H1 description</span>
                            <input name="h1_description" type="text" placeholder="Loan type's H1 description"
                                class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none" maxlength="191"
                                autocomplete="off" />
                        </label>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700">Section text</h2>
                    <div class="flex w-full mt-2 mb-6">
                        <label class="w-full">
                            <textarea class="w-full px-3 py-2 bg-gray-100 border rounded resize-y focus:outline-none focus:shadow-outline"
                                name="text"></textarea>
                        </label>
                        <script>
                            CKEDITOR.replace('text', {
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
                    <h2 class="text-lg font-medium text-gray-700">Active</h2>
                    <div class="flex mt-2 mb-6">
                        <label class="flex items-center text-gray-700 text-normal">
                            <input name="active" type="hidden" value="0">
                            <input name="active" type="checkbox" value="1" class="mr-2 form-checkbox text-primary">
                            Active
                        </label>
                    </div>
                    <div class="flex flex-row justify-end">
                        <button type="submit"
                            class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-loantypes");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
