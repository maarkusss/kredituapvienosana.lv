@extends('layouts.app')

@section('title', 'Add a section - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Add a new section</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    <form method="POST">
                        @csrf
                        <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Section</span>
                                <select
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="section">
                                    <option value="0">Select a section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Type</span>
                                <select
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="type">
                                    <option value="blog">Blog</option>
                                    <option value="contact">Contact us</option>
                                    <option value="cookies">Cookies</option>
                                    <option value="home">Homepage</option>
                                    <option value="reviews">Reviews</option>
                                    <option value="standard">Standard</option>
                                    <option value="faqs">Faq</option>
                                </select>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Routing name *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="routing_name" type="text" placeholder="Section's routing name" required>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Name *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="name" type="text" placeholder="Section's name" required>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">&lt;title&gt; *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="title" type="text" placeholder="Section's title" required>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Redirect link</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="link" type="text" placeholder="Section's redirect link">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Image (required if blog
                                    type)</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="image" type="url" onchange="displayImage(this);" id="fileInput">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Image alt text</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="image_alt_text" type="text" placeholder="Section's image alt text">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Google description</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="googleDescription" name="name" type="text"
                                    placeholder="Section's Google description">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Google keywords</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="googleKeywords" type="text" placeholder="Section's Google keywords">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">Anchor element title</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="anchor_element_title" type="text" placeholder="Section's Anchor element title">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">H1</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="h1" type="text" placeholder="Section's H1">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600">H1 description</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="h1_description" type="text" placeholder="Section's H1 description">
                            </label>
                        </div>
                        <h2 class="text-lg font-medium text-gray-700">Section source</h2>
                        <div class="flex w-full mt-2 mb-6">
                            <label class="w-full">
                                <textarea
                                    class="w-full px-3 py-2 text-gray-800 bg-gray-100 border border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="sectionSource" placeholder="Section source text..."></textarea>
                            </label>
                            <script>
                                CKEDITOR.replace('sectionSource', {
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
                        <h2 class="text-lg font-medium text-gray-700">Section text</h2>
                        <div class="flex w-full mt-2 mb-6">
                            <label class="w-full">
                                <textarea
                                    class="w-full px-3 py-2 text-gray-800 bg-gray-100 border border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="sectionText" placeholder="Section text..."></textarea>
                            </label>
                            <script>
                                CKEDITOR.replace('sectionText', {
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
                        <h2 class="text-lg font-medium text-gray-700">Display in the header</h2>
                        <div class="flex mt-2 mb-6">
                            <label class="flex items-center text-gray-700 text-normal">
                                <input type="hidden" name="display_in_the_header" value="0">
                                <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                    name="display_in_the_header" type="checkbox" value="1">
                                Display in the header
                            </label>
                        </div>
                        <h2 class="text-lg font-medium text-gray-700">Active</h2>
                        <div class="flex mt-2 mb-6">
                            <label class="flex items-center text-gray-700 text-normal">
                                <input type="hidden" name="active" value="0">
                                <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                    name="active" type="checkbox" value="1">
                                Active
                            </label>
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
        const activeSection = document.getElementById("sidebar-sections");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
