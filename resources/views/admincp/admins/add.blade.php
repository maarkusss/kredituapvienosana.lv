@extends('layouts.app')

@section('title', 'Add an admin - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Add a new admin</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <form method="POST">
                        @csrf
                        <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                        <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Name *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="first_name" type="text" placeholder="Admin's name">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Surname *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="last_name" type="text" placeholder="Admin's surname">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Password *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="password" type="text" placeholder="Admin's password">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Username</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="username" type="text" placeholder="Admin's username">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Email</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="email" type="email" placeholder="Admin's email address">
                            </label>
                        </div>
                        <h2 class="text-lg font-medium text-gray-700">Permissions</h2>
                        <div class="flex flex-wrap mt-2 mb-6">
                            <div class="flex flex-col w-full -my-1 sm:w-2/4 lg:w-1/4">
                                <span class="font-medium text-gray-700">Admins</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view admins]" type="checkbox">
                                    View admins
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit admins]" type="checkbox">
                                    Edit admins
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add admins]" type="checkbox">
                                    Add admins
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete admins]" type="checkbox">
                                    Delete admins
                                </label>
                            </div>
                            <div class="flex flex-col w-full -my-1 sm:w-2/4 lg:w-1/4">
                                <span class="font-medium text-gray-700">Bans</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view bans]" type="checkbox">
                                    View bans
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit bans]" type="checkbox">
                                    Edit bans
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add bans]" type="checkbox">
                                    Add bans
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete bans]" type="checkbox">
                                    Delete bans
                                </label>
                            </div>
                            <div class="flex flex-col w-full -my-1 sm:w-2/4 lg:w-1/4">
                                <span class="font-medium text-gray-700">Settings</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view settings]" type="checkbox">
                                    View settings
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit settings]" type="checkbox">
                                    Edit settings
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-row justify-end">
                            <button
                                class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
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
        const activeSection = document.getElementById("sidebar-admins");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
