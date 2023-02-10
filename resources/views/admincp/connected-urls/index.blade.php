@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Connected urls - ' . $name->value)
@else
    @section('title', 'Connected urls - SomeLogo')
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
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Connected urls</h1>
                    <a href="{{ route('admincp.connected-urls.create') }}"
                        class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                        <svg class="w-5 h-5 mr-1 fill-current">
                            <path
                                d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                        </svg>
                        <span>
                            Add connected url
                        </span>
                    </a>
                    {{-- <form>
                        <select name="filter"
                                class="px-3 py-2 pr-8 mt-2 text-gray-700 bg-white border rounded appearance-none sm:mt-0 sm:mr-2 form-select"
                                onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="waiting"
                                    @if (request()->filter == 'waiting') selected @endif>Waiting</option>
                            <option value="confirmed"
                                    @if (request()->filter == 'confirmed') selected @endif>Confirmed</option>
                            <option value="rejected"
                                    @if (request()->filter == 'rejected') selected @endif>Rejected</option>
                        </select>
                    </form> --}}
                </div>

                <div class="flex flex-col items-start justify-start w-full min-h-full bg-transparent">
                    <div class="w-full p-4 bg-white rounded">
                        <div class="overflow-x-auto whitespace-no-wrap ">
                            <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                                <thead>
                                    <tr class="border-b">
                                        <th class="p-3 text-sm text-gray-700">Url from</th>
                                        <th class="p-3 text-sm text-gray-700">Url to</th>
                                        <th class="p-3 text-sm text-gray-700">Updated</th>
                                        <th class="p-3 text-sm text-gray-700">Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($connectedUrls as $url)
                                        <tr class="border-b hover:bg-gray-100">
                                            <td class="p-2 text-center">
                                                <div class="flex items-center justify-center">
                                                    <a href="{{ route('admincp.connected-urls.edit', ['connected_url' => $url->id]) }}"
                                                        class="underline hover:text-primary">
                                                        {{ $url->url_from }}
                                                    </a>
                                                    {{-- @if (\App\Models\Admincp\urls\urls::where('parent_type_id', $url->id)->count() > 0)
                                                    <a href="#"
                                                       onclick="openSubsections('subsections_{{ $url->id }}');">
                                                        <svg class="w-5 h-5 ml-1 fill-current">
                                                            <path d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                                                        </svg>
                                                    </a>
                                                @endif --}}
                                                </div>
                                            </td>
                                            <td class="p-2 text-center">
                                                <span>{{ $url->url_to }}</span>
                                            </td>
                                            <td class="p-2 text-center">
                                                <span>{{ $url->updated_at }}</span>
                                            </td>
                                            <td class="p-2 text-center">
                                                <span>{{ $url->created_at }}</span>
                                            </td>
                                        </tr>
                                        {{-- @if ($subsections = \App\Models\Admincp\urls\urls::where('parent_type_id', $url->id)->orderBy('order', 'ASC')->get())
                                        @foreach ($subsections as $subsection)
                                            <tr class="hidden text-sm bg-gray-200 border-b hover:bg-gray-300"
                                                id="subsections_{{ $url->id }}">
                                                <td class="p-2 text-center">
                                                    <label>
                                                        <input name="subsection[order][{{ $subsection->id }}]"
                                                               type="number"
                                                               value="{{ $subsection->order }}"
                                                               class="w-16 px-2 py-1 text-center border rounded appearance-none">
                                                    </label>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <a href="{{ route('admincp.urls.edit', ['loantype' => $subsection->id]) }}"
                                                       class="underline hover:text-primary">
                                                        {{ $subsection->name }}
                                                    </a>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <span>{{ $subsection->updated_at }}</span>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <span>{{ $subsection->created_at }}</span>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <label class="flex justify-center">
                                                        <input type="hidden"
                                                               value="0"
                                                               name="subsection[active][{{ $subsection->id }}]">
                                                        <input name="subsection[active][{{ $subsection->id }}]"
                                                               value="1"
                                                               type="checkbox"
                                                               @if ($subsection->active) checked @endif
                                                               class="form-checkbox text-primary">
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif --}}
                                    @empty
                                        <tr>
                                            <td>No connected urls to show!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="flex justify-end mt-6">
                            <button class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                <span>Save</span>
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-urls");

        activeSection.classList.add("text-gray-600", "bg-gray-200");

        // function openSubsections(e) {
        //     const subSections = document.querySelectorAll("#" + e);
        //     for (let i = 0; i < subSections.length; i++) {
        //         subSections[i].classList.toggle("hidden");
        //     }
        // }
    </script>
@endsection
