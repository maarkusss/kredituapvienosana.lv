@extends('layouts.app')

@section('title', 'Lenders - ' . env('APP_NAME'))

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
                <div class="flex flex-col justify-between w-full mb-4 sm:flex-row">
                    <h1 class="text-2xl font-medium text-gray-700">Lenders</h1>
                    <div class="flex flex-col items-start sm:flex-row sm:items-center">
                        <form>
                            <select class="px-3 py-2 pr-8 mt-2 text-gray-700 bg-white border border-gray-300 rounded sm:mt-0 sm:mr-2 focus:border-primary-dark focus:ring-primary-dark"
                                    name="sorting"
                                    onchange="this.form.submit()">
                                <option value="">Select a layout</option>
                                @foreach ($sortings as $sorting)
                                    <option value="{{ $sorting->id }}"
                                            @if ($sorting->id == request()->sorting) selected @endif>{{ $sorting->campaign_name }}
                                        ({{ $sorting->clicks }})
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <a href="{{ route('admincp.lenders.add.index') }}"
                           class="flex flex-row items-center px-3 py-2 mt-2 text-sm font-medium text-white bg-gray-700 rounded sm:mt-0 hover:bg-gray-800">
                            <svg class="w-5 h-5 mr-1 fill-current">
                                <path d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                            </svg>
                            <span>
                                Add lender
                            </span>
                        </a>
                    </div>
                </div>
                <form method="POST"
                      class="w-full p-4 bg-white rounded">
                    @csrf
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                            <thead>
                                <tr>
                                    <th class="p-3 text-sm text-gray-700">Lender</th>
                                    <th class="p-3 text-sm text-gray-700">Position</th>
                                    <th class="p-3 text-sm text-gray-700">Frequency</th>
                                    <th class="p-3 text-sm text-gray-700">Daily EPC</th>
                                    <th class="p-3 text-sm text-gray-700">Daily EPC before</th>
                                    <th class="p-3 text-sm text-gray-700">Guaranteed EPC</th>
                                    <th class="p-3 text-sm text-gray-700">Earnings</th>
                                    <th class="p-3 text-sm text-gray-700">Clicks</th>
                                    <th class="p-3 text-sm text-gray-700">EPC</th>
                                    <th class="p-3 text-sm text-gray-700">Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lenders as $lender)
                                    <tr>
                                        <td class="p-3 text-center border">
                                            <a href="{{ route('admincp.lenders.edit.index', ['lender_id' => $lender->id]) }}">
                                                <img class="object-contain h-16 mx-auto"
                                                     src="{{ $lender->image }}"
                                                     alt="{{ $lender->name }}">
                                                <span>{{ $lender->name }}</span>
                                            </a>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <label>
                                                <input class="w-16 px-2 py-1 text-center border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                                       name="position[{{ $lender->id }}]"
                                                       type="text"
                                                       value="{{ $lender->position }}">
                                            </label>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <label>
                                                <input class="w-16 px-2 py-1 text-center border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                                       name="frequency[{{ $lender->id }}]"
                                                       type="number"
                                                       value="{{ $lender->frequency }}">
                                            </label>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <label>
                                                <input class="w-16 px-2 py-1 text-center border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                                       name="daily_epc[{{ $lender->id }}]"
                                                       type="number"
                                                       value="{{ $lender->daily_epc }}">
                                            </label>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <label>
                                                <input class="w-16 px-2 py-1 text-center border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                                       name="daily_epc_before[{{ $lender->id }}]"
                                                       type="number"
                                                       value="{{ $lender->daily_epc_before }}">
                                            </label>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <label>
                                                <input class="w-16 px-2 py-1 text-center border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark"
                                                       name="guaranteed_epc[{{ $lender->id }}]"
                                                       type="text"
                                                       value="{{ $lender->guaranteed_epc }}">
                                            </label>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <span>{{ $lender->earnings }}</span>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <span>{{ $lender->clicks }}</span>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <span>{{ $lender->epc }}</span>
                                        </td>
                                        <td class="p-3 text-center border">
                                            <label class="flex justify-center">
                                                <input type="hidden"
                                                       name="active[{{ $lender->id }}]"
                                                       value="0">
                                                <input class="border-gray-300 rounded text-primary-normal focus:ring-primary-dark"
                                                       name="active[{{ $lender->id }}]"
                                                       type="checkbox"
                                                       value="1"
                                                       @if ($lender->active) checked @endif>
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No lenders to display!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if (!request()->sorting)
                        <div class="flex justify-end mt-6">
                            <button class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white rounded bg-primary-normal hover:bg-primary-dark"
                                    type="submit"
                                    name="action"
                                    value="save">
                                Save
                            </button>
                        </div>
                    @endif
            </div>
        </div>
    </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-lenders");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
