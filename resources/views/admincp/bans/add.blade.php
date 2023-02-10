@extends('layouts.app')

@section('title', 'Add a ban - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Add a new ban</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <form method="POST">
                        @csrf
                        <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                        <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">IP *</span>
                                <input class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                       name="ip"
                                       type="text"
                                       placeholder="Banned IP">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Reason</span>
                                <input class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:ring-primary-dark focus:border-primary-dark"
                                       name="reason"
                                       type="text"
                                       placeholder="Reason for banning">
                            </label>
                        </div>
                        <div class="flex flex-row justify-end">
                            <button class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
                                    type="submit">
                                Add
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
        const activeSection = document.getElementById("sidebar-bans");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
