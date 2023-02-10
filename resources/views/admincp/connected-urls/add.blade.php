@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Add connected url - ' . $name->value)
@else
    @section('title', 'Add connected url - SomeLogo')
@endif

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
                    <h1 class="text-2xl font-medium text-gray-700">Add connected url</h1>
                </div>
                <form action={{ route('admincp.connected-urls.store') }}
                      method="POST"
                      class="w-full p-4 bg-white rounded"
                      enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    <div class="grid gap-4 mt-2 mb-6">
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Url from</span>
                            <input name="urlFrom"
                                   type="url"
                                   placeholder="Url from"
                                   class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none"
                                   required>
                        </label>
                    </div>
                    <div class="grid gap-4 mt-2 mb-6">
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">Url to</span>
                            <input name="urlTo"
                                   type="url"
                                   placeholder="Url to"
                                   class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none"
                                   required>
                        </label>
                    </div>
                    <div class="flex flex-row justify-end">
                        <button type="submit"
                                name="action"
                                value="save"
                                class="flex flex-row items-center px-3 py-2 mr-3 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                            Save
                        </button>
                        {{-- <button type="submit"
                                name="action"
                                value="delete"
                                class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to delete this item?');">
                            Delete
                        </button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-urls");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        const confirmed = document.getElementById('confirmed');
        const rejected = document.getElementById('rejected');
    </script>
@endsection
