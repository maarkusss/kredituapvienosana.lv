@extends('layouts.app')

@section('title', 'Edit an admin - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Edit admin - {{ $user->first_name }}
                        {{ $user->last_name }} ({{ $user->username }})</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <form method="POST">
                        @csrf
                        <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                        <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Name *</span>
                                <input name="first_name" type="text" value="{{ $user->first_name }}"
                                    placeholder="Admin's name"
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Surname *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="last_name" type="text" value="{{ $user->last_name }}"
                                    placeholder="Admin's surname">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Password (only if changing)</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="password" type="text" placeholder="Admin's password">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Username</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="username" type="text" value="{{ $user->username }}"
                                    placeholder="Admin's username">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Email</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="email" type="email" value="{{ $user->email }}" placeholder="Admin's email">
                            </label>
                        </div>
                        <h2 class="text-lg font-medium text-gray-700">Permissions</h2>
                        <div class="pt-4">
                            <span class="font-medium text-gray-700">Check all</span>
                            <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                <input type="checkbox" id='checkAll' class="mr-2 text-primary-normal">
                                All permissions
                            </label>
                        </div>
                        <div class="grid grid-cols-1 my-4 sm:grid-cols-2 xl:grid-cols-6 md:grid-cols-4 lg:grid-cols-4">
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Admins</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view admins]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view admins')) checked @endif>
                                    View admins
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit admins]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit admins')) checked @endif>
                                    Edit admins
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add admins]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add admins')) checked @endif>
                                    Add admins
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete admins]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete admins')) checked @endif>
                                    Delete admins
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Bans</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view bans]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view bans')) checked @endif>
                                    View bans
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit bans]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit bans')) checked @endif>
                                    Edit bans
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add bans]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add bans')) checked @endif>
                                    Add bans
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete bans]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete bans')) checked @endif>
                                    Delete bans
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Sections</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view sections]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view sections')) checked @endif>
                                    View sections
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add sections]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add sections')) checked @endif>
                                    Add sections
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit sections]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit sections')) checked @endif>
                                    Edit sections
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete sections]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete sections')) checked @endif>
                                    Delete sections
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <div class="mb-3">
                                    <span class="font-medium text-gray-700">Visitors</span>
                                    <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                        <input
                                            class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                            name="permissions[view visitors]" type="checkbox"
                                            @if ($user->getPermissionNames()->contains('view visitors')) checked @endif>
                                        View visitors
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Settings</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view settings]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view settings')) checked @endif>
                                    View settings
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit settings]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit settings')) checked @endif>
                                    Edit settings
                                </label>
                            </div>

                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Loan types</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view loantypes]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view loantypes')) checked @endif>
                                    View loan types
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add loantypes]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add loantypes')) checked @endif>
                                    Add loan types
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit loantypes]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit loantypes')) checked @endif>
                                    Edit loan types
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete loantypes]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete loantypes')) checked @endif>
                                    Delete loan types
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Faqs</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view faqs]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view faqs')) checked @endif>
                                    View faqs
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add faqs]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add faqs')) checked @endif>
                                    Add faqs
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit faqs]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit faqs')) checked @endif>
                                    Edit faqs
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete faqs]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete faqs')) checked @endif>
                                    Delete faqs
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Redirect links</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view redirectlinks]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view redirectlinks')) checked @endif>
                                    View redirectlinks
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add redirectlinks]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add redirectlinks')) checked @endif>
                                    Add redirectlinks
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit redirectlinks]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit redirectlinks')) checked @endif>
                                    Edit redirectlinks
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete redirectlinks]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete redirectlinks')) checked @endif>
                                    Delete redirectlinks
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Lenders</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view lenders]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view lenders')) checked @endif>
                                    View lenders
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[add lenders]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('add lenders')) checked @endif>
                                    Add lenders
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[edit lenders]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('edit lenders')) checked @endif>
                                    Edit lenders
                                </label>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[delete lenders]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('delete lenders')) checked @endif>
                                    Delete lenders
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <div class="mb-3">
                                    <span class="font-medium text-gray-700">Consumers</span>
                                    <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                        <input
                                            class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                            name="permissions[view consumers]" type="checkbox"
                                            @if ($user->getPermissionNames()->contains('view consumers')) checked @endif>
                                        View consumers
                                    </label>
                                    <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                        <input
                                            class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                            name="permissions[delete consumers]" type="checkbox"
                                            @if ($user->getPermissionNames()->contains('delete consumers')) checked @endif>
                                        Delete consumers
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Statistics</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view statistics]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view statistics')) checked @endif>
                                    View statistics
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Images</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view images]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view images')) checked @endif>
                                    View images
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Reviews</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view reviews]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view reviews')) checked @endif>
                                    View reviews
                                </label>
                            </div>
                            <div class="flex flex-col w-full my-4">
                                <span class="font-medium text-gray-700">Connected urls</span>
                                <label class="flex items-center mx-2 my-1 text-gray-700 text-normal">
                                    <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                        name="permissions[view connected urls]" type="checkbox"
                                        @if ($user->getPermissionNames()->contains('view connected urls')) checked @endif>
                                    View reviews
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-row justify-end mr-4">
                            <button
                                class="flex flex-row items-center order-2 px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
                                type="submit">
                                Save
                            </button>
                    </form>
                    <form action="{{ route('admincp.admins.edit.delete', ['user_id' => $user->id]) }}" method="POST">
                        @csrf
                        @if (auth()->id() !== $user->id)
                            <button
                                class="flex flex-row items-center px-3 py-2 mr-3 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
                                type="submit" onclick="return confirm('Are you sure you want to delete this item?');">
                                Delete
                            </button>
                        @endif
                    </form>
                </div>
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

<script src="{{ mix('js/checkAllPermissions.js') }}"></script>
