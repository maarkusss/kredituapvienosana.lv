@extends('layouts.app')

@section('title', 'Statistics - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Statistics</h1>
                    <div>
                        <form class="flex flex-col items-start sm:flex-row sm:items-center">
                            <label>
                                <input class="px-3 py-2 mt-2 text-gray-700 bg-white border-gray-300 rounded sm:mt-0 focus:border-primary-dark focus:ring-primary-dark"
                                       name="datePicker"
                                       type="text"
                                       placeholder="Select Date.."
                                       id="datepickr-element"
                                       value="{{ request()->datePicker }}">
                            </label>
                            <button class="flex flex-row items-center px-3 py-2 mt-2 text-sm font-medium text-white bg-gray-700 rounded sm:mt-0 sm:ml-2 hover:bg-gray-800"
                                    type="submit">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <div id="chart">
                    </div>
                </div>
                <div class="w-full p-4 mt-3 bg-white rounded">
                    <div class="overflow-x-auto whitespace-no-wrap ">
                        <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="p-3 text-sm text-gray-700"></th>
                                    <th class="p-3 text-sm text-gray-700">Confirmed</th>
                                    <th class="p-3 text-sm text-gray-700">Waiting</th>
                                    <th class="p-3 text-sm text-gray-700">Clicks</th>
                                    <th class="p-3 text-sm text-gray-700">EPC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lenders as $lender)
                                    <tr class="border-b hover:bg-gray-100">
                                        <th class="p-3 text-sm text-gray-700">
                                            {{ $lender['name'] }}
                                        </th>
                                        <td class="p-2 text-center">
                                            <span>{{ $lender['confirmed'] }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $lender['waiting'] }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span>{{ $lender['clicks'] }}</span>
                                        </td>
                                        <td class="p-2 text-center">
                                            <span class="font-medium"
                                                  style="{{ $lender['style'] }}">{{ sprintf('%.2f', $lender['epc']) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No lenders to show!</td>
                                    </tr>
                                @endforelse
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
        const activeSection = document.getElementById("sidebar-statistics");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        let options = {
            chart: {
                type: "area",
                toolbar: {
                    tools: {
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        reset: false,
                        pan: false
                    }
                },
                height: '400px'
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: "Commissions",
                    data: [{!! implode(', ', $chart_data['commissions']) !!}]
                },
                {
                    name: "Clicks",
                    data: [{!! implode(', ', $chart_data['clicks']) !!}]
                },
                {
                    name: "Visitors",
                    data: [{!! implode(', ', $chart_data['visitors']) !!}]
                },

            ],
            xaxis: {
                categories: ["{!! implode('", "', array_keys($chart_data['clicks'])) !!}"]
            }
        };

        let element = document.getElementById("datepickr-element");

        flatpickr(element, {
            dateFormat: "d.m.Y",
            mode: "range"
        });
    </script>
@endsection
