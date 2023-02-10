@extends('layouts.app')

@section('title', 'Overview - ' . env('APP_NAME'))

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
                <div class="flex flex-wrap justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-700">Overview</h1>
                </div>
                <div class="flex flex-col w-full -mx-2 md:flex-row">
                    <div class="flex flex-col w-full mx-2 md:w-1/3"
                         id="overview_statistics">
                        <div class="flex items-center justify-between flex-1 p-4 mb-3 leading-none bg-white rounded">
                            <div class="flex flex-col">
                                <span class="mb-2 text-3xl font-medium text-primary-normal">{{ $data['commissions']['today'] }}</span>
                                <span class="font-normal text-gray-500 text-normal">Commissions today</span>
                            </div>
                            <div>
                                <span class="text-xl font-medium {{ $data['commissions']['color'] }}">{{ $data['commissions']['percentage'] }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between flex-1 p-4 mb-3 leading-none bg-white rounded">
                            <div class="flex flex-col">
                                <span class="mb-2 text-3xl font-medium text-primary-normal">{{ $data['clicks']['today'] }}</span>
                                <span class="font-normal text-gray-500 text-normal">Clicks today</span>
                            </div>
                            <div>
                                <span class="text-xl font-medium {{ $data['clicks']['color'] }}">{{ $data['clicks']['percentage'] }}%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between flex-1 p-4 mb-3 leading-none bg-white rounded md:mb-0">
                            <div class="flex flex-col">
                                <span class="mb-2 text-3xl font-medium text-primary-normal">{{ $data['visitors']['today'] }}</span>
                                <span class="font-normal text-gray-500 text-normal">Visitors today</span>
                            </div>
                            <div>
                                <span class="text-xl font-medium {{ $data['visitors']['color'] }}">{{ $data['visitors']['percentage'] }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full p-4 mx-2 bg-white rounded md:w-2/3">
                        <div id="chart"
                             class="h-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-overview");

        activeSection.classList.add("text-gray-600", "bg-gray-100");

        let chartHeight = document.querySelector("#overview_statistics").clientHeight;

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
                height: chartHeight,
                maintainAspectRatio: false,
                responsive: true,
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
        }
    </script>
@endsection
