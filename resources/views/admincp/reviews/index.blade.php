@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Reviews | ' . $name->value)
@else
    @section('title', 'Reviews - SomeLogo')
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
                    <h1 class="text-2xl font-medium text-gray-800">Reviews</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-800 whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-3 text-sm text-gray-800"></th>
                                    <th class="p-3 text-sm text-gray-800">ID</th>
                                    <th class="p-3 text-sm text-gray-800">Name</th>
                                    <th class="p-3 text-sm text-left text-gray-800">Text</th>
                                    <th class="p-3 text-sm text-gray-800">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reviews as $review)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-2 text-center">
                                            <a href="{{ route('admincp.reviews.delete', ['id' => $review->id]) }}"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                <svg class="w-5 h-5 text-red-600 fill-current hover:text-red-700">
                                                    <path
                                                        d="M8.333 15a.833.833 0 0 0 .834-.833v-5a.833.833 0 1 0-1.667 0v5a.833.833 0 0 0 .833.833zm8.334-10h-3.334v-.833a2.5 2.5 0 0 0-2.5-2.5H9.167a2.5 2.5 0 0 0-2.5 2.5V5H3.333a.833.833 0 0 0 0 1.667h.834v9.166a2.5 2.5 0 0 0 2.5 2.5h6.666a2.5 2.5 0 0 0 2.5-2.5V6.667h.834a.833.833 0 0 0 0-1.667zm-8.334-.833a.833.833 0 0 1 .834-.834h1.666a.833.833 0 0 1 .834.834V5H8.333v-.833zm5.834 11.666a.833.833 0 0 1-.834.834H6.667a.833.833 0 0 1-.834-.834V6.667h8.334v9.166zm-2.5-.833a.833.833 0 0 0 .833-.833v-5a.833.833 0 1 0-1.667 0v5a.833.833 0 0 0 .834.833z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $review->id }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $review->name }}</span>
                                        </td>
                                        <td class="p-2 text-left">
                                            <span>{{ $review->text }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $review->created_at }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No reviews to show!</td>
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
        const activeSection = document.getElementById("sidebar-reviews");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        function openSubsections(e) {
            const subSections = document.querySelectorAll("#" + e);
            for (let i = 0; i < subSections.length; i++) {
                subSections[i].classList.toggle("hidden");
            }
        }
    </script>
@endsection
