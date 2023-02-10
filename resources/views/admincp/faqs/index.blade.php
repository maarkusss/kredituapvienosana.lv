@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'faq | ' . $name->value)
@else
    @section('title', 'faq | Goodday.finance')
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
                <div class="w-full">
                    <div class="flex justify-between w-full mb-4">
                        <h1 class="text-2xl font-medium text-gray-800">Faq</h1>
                        @can('add faqs')
                            <a class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-gray-700 rounded hover:bg-gray-800"
                                href="{{ route('admincp.faqs.create') }}">
                                <svg class="w-5 h-5 mr-1 fill-current">
                                    <path
                                        d="M15.833 9.167h-5v-5a.833.833 0 1 0-1.666 0v5h-5a.833.833 0 1 0 0 1.666h5v5a.833.833 0 0 0 1.666 0v-5h5a.833.833 0 0 0 0-1.666z" />
                                </svg>
                                <span>
                                    Add faq
                                </span>
                            </a>
                        @endcan
                    </div>
                    <div class="w-full p-4 bg-white rounded">
                        <div class="overflow-x-auto whitespace-no-wrap ">
                            <table class="w-full overflow-x-scroll text-gray-800 whitespace-no-wrap table-auto">
                                <thead>
                                    <tr class="border-b">
                                        <th class="p-3 text-sm text-gray-800">Order</th>
                                        <th class="p-3 text-sm text-gray-800">Question</th>
                                        <th class="p-3 text-sm text-gray-800">Last edited</th>
                                        <th class="p-3 text-sm text-gray-800">Created</th>
                                        <th class="p-3 text-sm text-gray-800">Active</th>
                                    </tr>
                                </thead>
                                <form action="{{ route('admincp.faqs.updateOrder') }}" method="POST">
                                    @csrf
                                    @forelse($faqs as $faq)
                                        <tbody>
                                            <tr class="transition-colors duration-200 border-b hover:bg-gray-100">
                                                <td class="p-2 text-center">
                                                    <label>
                                                        <input
                                                            class="w-16 px-2 py-1 text-center text-gray-800 border-gray-300 rounded focus:ring-primary-500 focus:border-primary-500"
                                                            name="faq[order][{{ $faq->id }}]" type="text"
                                                            value="{{ $faq->order }}">
                                                    </label>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <div class="flex items-center justify-center">
                                                        <a class="underline transition-colors duration-200 hover:text-primary-500"
                                                            href="{{ route('admincp.faqs.edit', ['faq' => $faq->id]) }}">
                                                            {{ $faq->question }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <span>{{ $faq->updated_at }}</span>
                                                </td>
                                                <td class="p-2 text-center">
                                                    <span>{{ $faq->created_at }}</span>
                                                </td>
                                                <td class="p-2 text-center ">
                                                    <label class="flex justify-center">
                                                        <input type="hidden" name="faq[active][{{ $faq->id }}]"
                                                            value="0">
                                                        <input
                                                            class="border-gray-300 rounded form-checkbox text-primary-500 focus:ring-primary-500"
                                                            name="faq[active][{{ $faq->id }}]" value="1"
                                                            type="checkbox"
                                                            @if ($faq->active) checked @endif>
                                                    </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @empty
                                        <tbody>
                                            <tr>
                                                <td>No faq to display!</td>
                                            </tr>
                                        </tbody>
                                    @endforelse
                            </table>
                            @can('edit faqs')
                                <div class="flex justify-end mt-6">
                                    <button
                                        class="px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-gray-600 rounded hover:bg-gray-800"
                                        type="submit">
                                        Save
                                    </button>
                                </div>
                            @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-faq");
        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
