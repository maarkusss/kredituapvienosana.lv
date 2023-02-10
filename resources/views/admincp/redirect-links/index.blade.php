@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Redirect links - ' . $name->value)
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
            <form method="POST" class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                @csrf
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Redirect links</h1>
                    <a href="{{ route('admincp.redirect-links.create') }}"
                        class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                        <svg class="w-5 h-5 mr-1 fill-current">
                            <path
                                d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                        </svg>
                        <span>
                            Create a redirect link
                        </span>
                    </a>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-3 text-sm text-gray-700">URL from</th>
                                    <th class="p-3 text-sm text-gray-700">URL to</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($redirect_links as $redirect_link)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-2 text-center">
                                            <a class="underline hover:text-primary"
                                                href="{{ route('admincp.redirect-links.edit', ['redirect_link' => $redirect_link->id]) }}">
                                                {{ $redirect_link->url_from }}
                                            </a>
                                        </td>
                                        <td class="p-2 text-center">
                                            {{ $redirect_link->url_to }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No redirect links to show!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-redirect-links");

        activeSection.classList.add("text-gray-600", "bg-gray-200");
    </script>
@endsection
