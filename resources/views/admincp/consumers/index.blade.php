@extends('layouts.app')

@section('title', 'Consumers - ' . env('APP_NAME'))

@section('content')
    <div class="flex flex-col w-full min-h-screen pt-16 bg-gray-100 lg:pl-56">
        <!-- Header -->
        @include('admincp.components.header')
        <!-- Main content -->
        <div class="flex flex-row flex-1 h-full">
            <!-- Sidebar -->
            @include('admincp.components.sidebar')
            <!-- Container -->
            <div class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                <div class="flex flex-col justify-between w-full mb-4 sm:flex-row">
                    <h1 class="text-2xl font-medium text-gray-700">Consumers</h1>
                    <div>
                        <label>
                            <form>
                                <input class="px-3 py-2 mt-2 text-gray-700 bg-white border-gray-300 rounded focus:border-primary-dark focus:ring-primary-dark sm:mt-0"
                                       name="search"
                                       type="text"
                                       placeholder="Search">
                            </form>
                        </label>
                    </div>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-3 text-sm text-gray-700">Name, surname</th>
                                    <th class="p-3 text-sm text-gray-700">Date of birth</th>
                                    <th class="p-3 text-sm text-gray-700">E-mail</th>
                                    <th class="p-3 text-sm text-gray-700">Phone</th>
                                    <th class="p-3 text-sm text-gray-700">Amount</th>
                                    <th class="p-3 text-sm text-gray-700">Term</th>
                                    <th class="p-3 text-sm text-gray-700">Type</th>
                                    <th class="p-3 text-sm text-gray-700">Confirmed</th>
                                    <th class="p-3 text-sm text-gray-700">Unsubscribed</th>
                                    <th class="p-3 text-sm text-gray-700">IP</th>
                                    <th class="p-3 text-sm text-gray-700">utm_source</th>
                                    <th class="p-3 text-sm text-gray-700">utm_medium</th>
                                    <th class="p-3 text-sm text-gray-700">utm_campaign</th>
                                    <th class="p-3 text-sm text-gray-700">utm_content</th>
                                    <th class="p-3 text-sm text-gray-700">gclid</th>
                                    <th class="p-3 text-sm text-gray-700">Date</th>
                                    <th class="p-3 text-sm text-gray-700">Confirmation link</th>
                                    <th class="p-3 text-sm text-gray-700"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($consumers as $consumer)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->first_name . ' ' . $consumer->last_name }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->birth }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->email }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->phone }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>€{{ $consumer->amount }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->term }} days</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->type }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            @if ($consumer->confirmed)
                                                <svg class="w-5 h-5 mx-auto text-green-500 fill-current">
                                                    <path d="M15.592 6.008a.833.833 0 0 0-1.184 0L8.2 12.225 5.592 9.608a.852.852 0 0 0-1.184 1.225l3.2 3.2a.833.833 0 0 0 1.184 0l6.8-6.8a.834.834 0 0 0 0-1.225z" />
                                                </svg>
                                            @endif
                                        </td>
                                        <td class="p-2 text-center">
                                            @if ($consumer->subscribed)
                                                <svg class="w-5 h-5 mx-auto text-green-500 fill-current">
                                                    <path d="M15.592 6.008a.833.833 0 0 0-1.184 0L8.2 12.225 5.592 9.608a.852.852 0 0 0-1.184 1.225l3.2 3.2a.833.833 0 0 0 1.184 0l6.8-6.8a.834.834 0 0 0 0-1.225z" />
                                                </svg>
                                            @endif
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->ip }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->utm_source }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->utm_medium }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->utm_campaign }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->utm_content }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->gclid }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $consumer->created_at }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <a class="underline hover:text-primary-normal @if ($consumer->confirmed) disabled @endif"
                                               href="#">
                                                Confirm
                                            </a>
                                        </td>
                                        <td class="p-2 text-center">
                                            <form method="POST"
                                                  action="{{ route('admincp.consumers.delete', ['consumer_id' => $consumer->id]) }}">
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <svg class="w-5 h-5 text-red-600 fill-current hover:text-red-700">
                                                        <path d="M8.333 15a.833.833 0 0 0 .834-.833v-5a.833.833 0 1 0-1.667 0v5a.833.833 0 0 0 .833.833zm8.334-10h-3.334v-.833a2.5 2.5 0 0 0-2.5-2.5H9.167a2.5 2.5 0 0 0-2.5 2.5V5H3.333a.833.833 0 0 0 0 1.667h.834v9.166a2.5 2.5 0 0 0 2.5 2.5h6.666a2.5 2.5 0 0 0 2.5-2.5V6.667h.834a.833.833 0 0 0 0-1.667zm-8.334-.833a.833.833 0 0 1 .834-.834h1.666a.833.833 0 0 1 .834.834V5H8.333v-.833zm5.834 11.666a.833.833 0 0 1-.834.834H6.667a.833.833 0 0 1-.834-.834V6.667h8.334v9.166zm-2.5-.833a.833.833 0 0 0 .833-.833v-5a.833.833 0 1 0-1.667 0v5a.833.833 0 0 0 .834.833z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No consumers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $consumers->links('admincp.components.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-consumers");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
