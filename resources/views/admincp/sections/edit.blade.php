@extends('layouts.app')

@section('title', 'Edit a section - ' . env('APP_NAME'))

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
                <div class="flex flex-col justify-between w-full mb-4 sm:flex-row">
                    <div class="flex flex-col">
                        <h1 class="text-2xl font-medium text-gray-700">Edit section - {{ $section->name }}</h1>
                        @if (request()->history)
                            <span class="font-bold text-red-400">Ierakstu izveidoja - {{ $section->user->first_name }}
                                {{ $section->user->last_name }}</span>
                        @endif
                    </div>
                    <div>
                        <form>
                            <select
                                class="px-3 py-2 mt-2 text-gray-700 bg-white border-gray-300 rounded sm:mt-0 focus:border-primary-dark focus:ring-primary-dark"
                                name="history" onchange="this.form.submit()">
                                <option selected value="">History</option>
                                @foreach ($history as $his)
                                    <option value="{{ $his->id }}" @if (request()->history == $his->id) selected @endif>
                                        {{ date('d.m.Y H:i:s', strtotime($his->created_at)) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                    @if ($section->image)
                        <div class="flex items-center justify-start h-48 my-4" id="lender-image-container">
                            <img class="object-contain max-w-full max-h-full" src="{{ $section->image }}" alt="Logo"
                                id="lender_image">
                        </div>
                    @else
                        <div class="flex items-center justify-start my-4" id="lender-image-container">
                            <img class="object-contain max-w-full max-h-full" id="lender-image">
                        </div>
                    @endif
                    <form method="POST">
                        @csrf
                        <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Section</span>
                                <select
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="section">
                                    <option value="0">Select a section</option>
                                    @foreach ($sections as $sec)
                                        <option value="{{ $sec->id }}"
                                            @if ($section->parent_section_id == $sec->id) selected @endif>{{ $sec->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Type</span>
                                <select
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="type">
                                    <option value="blog" @if ($section->type == 'blog') selected @endif>
                                        Blog
                                    </option>
                                    <option value="contact" @if ($section->type == 'contact') selected @endif>
                                        Contact Us
                                    </option>
                                    <option value="cookies" @if ($section->type == 'cookies') selected @endif>
                                        Cookies
                                    </option>
                                    <option value="home" @if ($section->type == 'home') selected @endif>
                                        Homepage
                                    </option>
                                    <option value="reviews" @if ($section->type == 'reviews') selected @endif>
                                        Reviews
                                    </option>
                                    <option value="standard" @if ($section->type == 'standard') selected @endif>
                                        Standard
                                    </option>
                                    <option value="faqs" @if ($section->type == 'faqs') selected @endif>
                                        Faq
                                    </option>
                                </select>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Routing name *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="routing_name" type="text" placeholder="Section's routing name"
                                    value="{{ $section->route_name }}" required>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Name *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="name" type="text" placeholder="Section's name" value="{{ $section->name }}"
                                    required>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">&lt;title&gt; *</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="title" type="text" placeholder="Section's title"
                                    value="{{ $section->title }}" required>
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Redirect link</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="link" type="text" placeholder="Section's redirect link"
                                    value="{{ $section->redirect_link }}">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Image (required if blog
                                    type)</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="image" type="url" value="{{ $section->image }}"
                                    onchange="displayImage(this);" id="fileInput">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Image alt text</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="image_alt_text" type="text" placeholder="Section's image alt text"
                                    value="{{ $section->image_alt_text }}">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Google
                                    description</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="googleDescription" name="name" type="text"
                                    placeholder="Section's Google description" value="{{ $section->description }}">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Google keywords</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="googleKeywords" type="text" placeholder="Section's Google keywords"
                                    value="{{ $section->keywords }}">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">Anchor element
                                    title</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="anchor_element_title" type="text"
                                    placeholder="Section's Anchor element title"
                                    value="{{ $section->anchor_element_title }}">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">H1</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="h1" type="text" placeholder="Section's H1"
                                    value="{{ $section->h1 }}">
                            </label>
                            <label class="flex flex-col w-full">
                                <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">H1 description</span>
                                <input
                                    class="px-3 py-2 text-gray-700 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="h1_description" type="text" placeholder="Section's H1 description"
                                    value="{{ $section->h1_description }}">
                            </label>
                        </div>
                        <h2 class="text-lg font-medium text-gray-700">Section source</h2>
                        <div class="flex w-full mt-2 mb-6">
                            <label class="w-full">
                                <textarea
                                    class="w-full px-3 py-2 text-gray-800 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="sectionSource" placeholder="Section source text...">{!! $section->source !!}</textarea>
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
                                    class="w-full px-3 py-2 text-gray-800 bg-gray-100 border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                    name="sectionText" placeholder="Section text...">{!! $section->text !!}</textarea>
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
                                    name="display_in_the_header" type="checkbox" value="1"
                                    @if ($section->display_in_the_header && !request()->history) checked @endif>
                                Display in the header
                            </label>
                        </div>
                        <h2 class="text-lg font-medium text-gray-700">Active</h2>
                        <div class="flex mt-2 mb-6">
                            <label class="flex items-center text-gray-700 text-normal">
                                <input type="hidden" name="active" value="0">
                                <input class="mr-2 border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                    name="active" type="checkbox" value="1"
                                    @if ($section->active && !request()->history) checked @endif>
                                Active
                            </label>
                        </div>
                        <div class="flex flex-row justify-end">
                            <button
                                class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
                                type="submit">
                                Edit
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

        activeSection.classList.add("text-gray-600");
        activeSection.classList.add("bg-gray-100");

        function displayImage(input) {
            let lenderImage = document.getElementById("lender-image");
            let lenderImageContainer = document.getElementById("lender-image-container");
            lenderImage.src = input.value;
            lenderImage.alt = "Logo";
            lenderImageContainer.classList.add("h-48");
        }
    </script>
@endsection
