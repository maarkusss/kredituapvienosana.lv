@extends('layouts.app')

@section('title', 'Admins - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Admins</h1>
                    @can('add admins')
                        <a href="{{ route('admincp.admins.add.index') }}"
                           class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                            <svg class="w-5 h-5 mr-1 fill-current">
                                <path d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                            </svg>
                            <span>
                                Add admin
                            </span>
                        </a>
                    @endcan
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-3 text-sm text-gray-700">Name</th>
                                    <th class="p-3 text-sm text-gray-700">Username</th>
                                    <th class="p-3 text-sm text-gray-700">Last logged in</th>
                                    <th class="p-3 text-sm text-gray-700"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-2 text-center">
                                            @can('edit admins')
                                                <a class="underline hover:text-primary-normal"
                                                   href="{{ route('admincp.admins.edit.index', ['user_id' => $user->id]) }}">
                                                @endcan
                                                {{ $user->first_name }} {{ $user->last_name }}
                                                @can('edit admins')
                                                </a>
                                            @endcan
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $user->username }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            @if (!empty(
                                                $user->LogInAttempts()->orderBy('created_at', 'DESC')->first()->created_at
                                            ))
                                                <span>{{ $user->LogInAttempts()->orderBy('created_at', 'DESC')->first()->created_at }}</span>
                                            @else
                                                <span>No data</span>
                                            @endif
                                        </td>
                                        @if (auth()->id() !== $user->id)
                                            @can('delete admins')
                                                <td class="p-2 text-center">
                                                    <form action="{{ route('admincp.admins.edit.delete', ['user_id' => $user->id]) }}"
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <svg class="w-5 h-5 text-red-600 fill-current hover:text-red-700">
                                                                <path d="M8.333 15a.833.833 0 0 0 .834-.833v-5a.833.833 0 1 0-1.667 0v5a.833.833 0 0 0 .833.833zm8.334-10h-3.334v-.833a2.5 2.5 0 0 0-2.5-2.5H9.167a2.5 2.5 0 0 0-2.5 2.5V5H3.333a.833.833 0 0 0 0 1.667h.834v9.166a2.5 2.5 0 0 0 2.5 2.5h6.666a2.5 2.5 0 0 0 2.5-2.5V6.667h.834a.833.833 0 0 0 0-1.667zm-8.334-.833a.833.833 0 0 1 .834-.834h1.666a.833.833 0 0 1 .834.834V5H8.333v-.833zm5.834 11.666a.833.833 0 0 1-.834.834H6.667a.833.833 0 0 1-.834-.834V6.667h8.334v9.166zm-2.5-.833a.833.833 0 0 0 .833-.833v-5a.833.833 0 1 0-1.667 0v5a.833.833 0 0 0 .834.833z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endcan
                                        @else
                                            <td class="p-2 text-center">
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

        let element = document.getElementById("datepickr-element");

        flatpickr(element, {
            dateFormat: "d.m.Y",
            mode: "range"
        });
    </script>
@endsection
