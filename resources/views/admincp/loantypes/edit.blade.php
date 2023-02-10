@extends('layouts.app')

@section('title', 'Edit a loan type - ' . env('APP_NAME'))

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
                    <div class="w-full p-4 bg-white rounded">
                        <div class="flex flex-col">
                            <h1 class="text-2xl font-medium text-gray-700">Edit loan type - {{ $loantype->name }}</h1>
                            @if (request()->history)
                                <span class="font-bold text-red-400">Ierakstu izveidoja - {{ $loantype->user->first_name }}
                                    {{ $loantype->user->last_name }}</span>
                            @endif
                        </div>
                        <form action={{ route('admincp.loantypes.update', ['loantype' => $loantype->id]) }} method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-700">Main information</h2>
                            @if ($loantype->image)
                                <div class="flex items-center justify-start h-24 my-4" id="lender-image-container">
                                    <img src="{{ $loantype->image }}" alt="Logo" id="lender_image"
                                        class="object-contain max-w-full max-h-full">
                                </div>
                            @else
                                <div class="flex items-center justify-start my-4" id="lender-image-container">
                                    <img id="lender-image" class="object-contain max-w-full max-h-full">
                                </div>
                            @endif
                            <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600 appearance-none">
                                        Parent loan type
                                    </span>
                                    <select name="type" id="type" class="px-3 py-2 border-gray-300 rounded-lg">
                                        <option value="0">Select a type</option>
                                        @foreach ($types as $type)
                                            @if ($type->id != $loantype->id)
                                                <option value="{{ $type->id }}"
                                                    @if ($loantype->parent_type_id == $type->id) selected @endif>{{ $type->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">Name</span>
                                    <input class="px-3 py-2 border-gray-300 rounded-lg" name="name" type="text"
                                        value="{{ $loantype->name }}" placeholder="Loan type's name">
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">Routing name *</span>
                                    <input class="px-3 py-2 border-gray-300 rounded-lg" name="route_name" type="text"
                                        value="{{ $loantype->route_name }}" placeholder="Loan type's link">
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">Title *</span>
                                    <input class="px-3 py-2 border-gray-300 rounded-lg" name="title" type="text"
                                        value="{{ $loantype->title }}" placeholder="Loan type's title">
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">Description</span>
                                    <input class="px-3 py-2 border-gray-300 rounded-lg" name="description" type="text"
                                        value="{{ $loantype->description }}" placeholder="Loan type's description">
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">Google keywords</span>
                                    <input class="px-3 py-2 border-gray-300 rounded-lg" name="keywords" type="text"
                                        value="{{ $loantype->keywords }}" placeholder="Loan type's Google keywords">
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">Anchor element title</span>
                                    <input name="anchor_element_title" type="text"
                                        placeholder="Loan type's anchor element's title"
                                        class="px-3 py-2 border-gray-300 rounded-lg"
                                        value="{{ $loantype->anchor_element_title }}" maxlength="191">
                                </label>
                            </div>
                            <h2 class="text-lg font-medium text-gray-700">H1, H1 description</h2>
                            <div class="grid gap-4 mt-2 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">H1</span>
                                    <input name="h1" type="text" placeholder="Loan type's H1"
                                        class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none"
                                        maxlength="191" autocomplete="off" value="{{ $loantype->h1 }}" />
                                </label>
                                <label class="flex flex-col">
                                    <span class="mb-2 text-sm font-medium text-gray-600">H1 description</span>
                                    <input name="h1_description" type="text" placeholder="Loan type's H1 description"
                                        class="px-3 py-2 text-gray-700 bg-gray-100 border rounded appearance-none"
                                        maxlength="191" autocomplete="off" value="{{ $loantype->h1_description }}" />
                                </label>
                            </div>
                            <h2 class="text-lg font-medium text-gray-700">Section text</h2>
                            <div class="flex w-full mt-2 mb-6">
                                <label class="w-full">
                                    <textarea class="w-full p-2 border-gray-300 rounded-lg resize-y" name="text" id="text">{!! $loantype->text !!}</textarea>
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
                                    <input type="hidden" name="active" value="0">
                                    <input class="mr-2 form-checkbox text-primary" name="active" type="checkbox"
                                        value="1" @if ($loantype->active && !request()->history) checked @endif>
                                    Active
                                </label>
                            </div>
                            <div class="flex flex-row items-center justify-end ">
                                <button
                                    class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                        @can('delete loantypes')
                            <form action="{{ route('admincp.loantypes.destroy', ['loantype' => $loantype->id]) }}"
                                method="POST">
                                @method('DELETE')
                                @csrf
                                <button
                                    class="flex flex-row items-center px-3 py-2 mt-2 ml-auto text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endsection

        @section('javascript')
            <script>
                const activeSection = document.getElementById("sidebar-loantypes");

                activeSection.classList.add("text-gray-600", "bg-gray-100");
            </script>
        @endsection
