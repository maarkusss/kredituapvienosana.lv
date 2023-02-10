@extends('layouts.app')

@section('title', 'Loan types - ' . env('APP_NAME'))

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
            <form action={{ route('admincp.loantypes.updateOrder') }} method="POST"
                class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                @csrf
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Loan types</h1>
                    <a href="{{ route('admincp.loantypes.create') }}"
                        class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                        <svg class="w-5 h-5 mr-1 fill-current">
                            <path
                                d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                        </svg>
                        <span>
                            Add loan type
                        </span>
                    </a>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-3 text-sm text-gray-700">Order</th>
                                    <th class="p-3 text-sm text-gray-700">Name</th>
                                    <th class="p-3 text-sm text-gray-700">Last edited</th>
                                    <th class="p-3 text-sm text-gray-700">Created</th>
                                    <th class="p-3 text-sm text-gray-700">Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loantypes as $loantype)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-2 text-center">
                                            <label>
                                                <input name="loantypes[order][{{ $loantype->id }}]" type="text"
                                                    value="{{ $loantype->order }}"
                                                    class="w-16 px-2 py-1 text-center border rounded appearance-none">
                                            </label>
                                        </td>
                                        <td class="p-2 text-center">
                                            <div class="flex items-center justify-center">
                                                <a href="{{ route('admincp.loantypes.edit', ['loantype' => $loantype->id]) }}"
                                                    class="underline hover:text-primary">
                                                    {{ $loantype->name }}
                                                </a>
                                                @if (\App\Models\Admincp\LoanTypes\LoanTypes::where('parent_type_id', $loantype->id)->count() > 0)
                                                    <a href="#"
                                                        onclick="openSubsections('subsections_{{ $loantype->id }}');">
                                                        <svg class="w-5 h-5 ml-1 fill-current">
                                                            <path
                                                                d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $loantype->updated_at }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $loantype->created_at }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <label class="flex justify-center">
                                                <input type="hidden" name="loantypes[active][{{ $loantype->id }}]"
                                                    value="0">
                                                <input name="loantypes[active][{{ $loantype->id }}]" type="checkbox"
                                                    value="1" class="form-checkbox text-primary"
                                                    @if ($loantype->active) checked @endif>
                                            </label>
                                        </td>
                                    </tr>
                                    @if ($subsections = \App\Models\Admincp\LoanTypes\LoanTypes::where('parent_type_id', $loantype->id)->orderBy('order', 'ASC')->get())
                                        @foreach ($subsections as $subsection)
                                            <tr class="hidden text-sm bg-gray-200 border-b hover:bg-gray-300"
                                                id="subsections_{{ $loantype->id }}">
                                                <td class="p-2 text-center">
                                                    <label>
                                                        <input name="subsection[order][{{ $subsection->id }}]"
                                                            type="number" value="{{ $subsection->order }}"
                                                            class="w-16 px-2 py-1 text-center border rounded appearance-none">
                                                    </label>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <a href="{{ route('admincp.loantypes.edit', ['loantype' => $subsection->id]) }}"
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
                                                        <input type="hidden" value="0"
                                                            name="subsection[active][{{ $subsection->id }}]">
                                                        <input name="subsection[active][{{ $subsection->id }}]"
                                                            value="1" type="checkbox"
                                                            @if ($subsection->active) checked @endif
                                                            class="form-checkbox text-primary">
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td>No loan types to show!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                            <span>Save</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-loantypes");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        function openSubsections(e) {
            const subSections = document.querySelectorAll("#" + e);
            for (let i = 0; i < subSections.length; i++) {
                subSections[i].classList.toggle("hidden");
            }
        }
    </script>
@endsection
