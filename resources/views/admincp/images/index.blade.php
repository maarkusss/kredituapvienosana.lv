@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Images - ' . $name->value)
@endif

@section('content')
    <div class="flex flex-col w-full min-h-screen pt-16 bg-gray-100 lg:pl-56">
        <!-- Header -->
        @include('admincp.components.header')
        <!-- Main content -->
        <!-- Info box -->
        @include('admincp.components.infobox')
        <!-- End info box -->
        <div class="flex flex-row flex-1 h-full">
            <!-- Sidebar -->
            @include('admincp.components.sidebar')
            <!-- Container -->
            <div class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                <div class="flex flex-wrap justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Images</h1>
                    <form class="flex items-center" action="{{ route('admincp.images.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="px-3 py-2 mr-2 text-xs text-gray-700 bg-white border rounded" name="image"
                            type="file" accept="image/*" required />
                        <button
                            class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800"
                            type="submit">
                            Add an image
                        </button>
                    </form>
                </div>
                <div class="grid w-full grid-cols-2 gap-4 lg:grid-cols-4 xl:grid-cols-6">
                    @foreach ($images as $image)
                        <div class="relative w-full p-1 bg-white border rounded-lg group">
                            <form class="absolute top-0 right-0 hidden mt-2 mr-2 group-hover:block"
                                action="{{ route('admincp.images.destroy', ['image' => $image]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="p-1 text-red-500 transition-all duration-200 bg-white rounded-full hover:shadow-lg hover:bg-gray-100 hover:text-red-600"
                                    type="submit" title="Delete image"
                                    onclick="return confirm('Are you sure you want to delete this image?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                            <div class="w-full h-48 mb-1">
                                <img class="object-cover object-center w-full h-full max-w-full max-h-full rounded-lg aspect-auto"
                                    src="{{ asset($image->path) }}" title="{{ asset($image->path) }}" />
                            </div>
                            <button
                                class="w-full text-sm text-center text-gray-800 underline break-words hover:text-primary-normal"
                                type="button" id="copy_image_url_button" title="{{ asset($image->path) }}"
                                data-url="{{ asset($image->path) }}">
                                Copy URL
                            </button>
                        </div>
                    @endforeach
                </div>
                {{ $images->links('admincp.components.pagination') }}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-images");
        activeSection.classList.add("text-gray-600", "bg-gray-100");

        const copyImageURLButtons = document.querySelectorAll("#copy_image_url_button");

        copyImageURLButtons.forEach(button => {
            button.addEventListener("click", () => {
                const url = button.dataset.url;

                navigator.clipboard.writeText(url).then(() => {
                    button.innerHTML = "Copied ✔️";

                    setInterval(() => {
                        button.innerHTML = "Copy URL";
                    }, 1000);
                }, () => {
                    button.innerHTML = "Failed to copy ❌";

                    setInterval(() => {
                        button.innerHTML = "Copy URL";
                    }, 1000);
                });
            })
        })
    </script>
@endsection
