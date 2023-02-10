@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Edit a redirect link - ' . $name->value)
@endif

@section('content')
    <div class="flex flex-col w-full min-h-screen pt-16 bg-gray-100 lg:pl-56">
        <!-- Header -->
        @include('admincp.components.header')
        <!-- Main content -->
        <!-- Info box -->
        @include('admincp.components.infobox')
        <!-- End info box -->
        <div class="flex flex-col flex-auto h-full">
            <!-- Sidebar -->
            @include('admincp.components.sidebar')
            <!-- Container -->
            <form class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent" method="POST"
                action="{{ route('admincp.redirect-links.update', ['redirect_link' => $redirect_link->id]) }}">
                @method('PUT')
                @csrf
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Edit a redirect link</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">
                                URL from *
                            </span>
                            <input class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none"
                                name="url_from" type="url" placeholder="URL from..."
                                value="{{ $redirect_link->url_from }}" maxlength="191" required>
                        </label>
                        <label class="flex flex-col">
                            <span class="mb-2 text-sm font-medium text-gray-600">
                                URL to *
                            </span>
                            <input class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none" name="url_to"
                                type="url" placeholder="URL to..." value="{{ $redirect_link->url_to }}" maxlength="191"
                                required>
                        </label>
                    </div>
                    <div class="flex flex-row justify-end">
                        <button
                            class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800"
                            type="submit">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
            @can('delete redirectlinks')
                <div class="px-8">
                    <form action="{{ route('admincp.redirect-links.destroy', ['redirect_link' => $redirect_link->id]) }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button
                            class="flex flex-row items-center px-3 py-2 mt-2 ml-auto text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to delete this item?');">
                            Delete
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-redirect-links");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
