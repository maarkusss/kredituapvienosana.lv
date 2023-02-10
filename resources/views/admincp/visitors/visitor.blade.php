@extends('layouts.app')

@section('title', 'Visitor #' . $visitor->id . ' - ' . env('APP_NAME'))

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
                    <h1 class="text-2xl font-medium text-gray-700">Visitor - {{ $visitor->id }}</h1>
                </div>
                <div class="w-full p-4 overflow-x-auto whitespace-no-wrap bg-white rounded">
                    <table class="w-full overflow-x-scroll text-gray-700 whitespace-no-wrap table-auto">
                        <thead>
                            <tr class="border-b">
                                <th class="p-3 text-sm text-gray-700">Lender</th>
                                <th class="p-3 text-sm text-gray-700">Referer</th>
                                <th class="p-3 text-sm text-gray-700">utm_source</th>
                                <th class="p-3 text-sm text-gray-700">utm_medium</th>
                                <th class="p-3 text-sm text-gray-700">utm_campaign</th>
                                <th class="p-3 text-sm text-gray-700">utm_content</th>
                                <th class="p-3 text-sm text-gray-700">gclid</th>
                                <th class="p-3 text-sm text-gray-700">User Agent</th>
                                <th class="p-3 text-sm text-gray-700">IP</th>
                                <th class="p-3 text-sm text-gray-700">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clicks as $click)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="p-2 text-center">
                                        <span>{{ $click->lender->name }}</span>
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->referer)
                                            <span>{{ $click->referer }}</span>
                                        @else
                                            <svg class="w-5 mx-auto text-red-400"
                                                 viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->utm_source)
                                            <span>{{ $click->utm_source }}</span>
                                        @else
                                            <svg class="w-5 mx-auto text-red-400"
                                                 viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->utm_medium)
                                            <span>{{ $click->utm_medium }}</span>
                                        @else
                                            <svg class="w-5 mx-auto text-red-400"
                                                 viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->utm_campaign)
                                            <span>{{ $click->utm_campaign }}</span>
                                        @else
                                            <svg class="w-5 mx-auto text-red-400"
                                                 viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->utm_content)
                                            <span>{{ $click->utm_content }}</span>
                                        @else
                                            <svg class="w-5 mx-auto text-red-400"
                                                 viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->gclid)
                                            <span>{{ $click->gclid }}</span>
                                        @else
                                            <svg class="w-5 mx-auto text-red-400"
                                                 viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        <div class="flex justify-center">
                                            @if ($agent->isMobile($visitor->user_agent))
                                                <a href="#"
                                                   onclick="prompt('USER AGENT','{{ $visitor->user_agent }}');return false;">
                                                    <svg class="w-5 h-5 text-gray-700 fill-current">
                                                        <path d="M10.592 13.575l-.125-.1a.629.629 0 0 0-.15-.075l-.15-.067a.834.834 0 0 0-.759.225.958.958 0 0 0-.175.275.834.834 0 0 0 1.084 1.092c.1-.048.192-.11.275-.183a.832.832 0 0 0 0-1.167zm2.741-11.908H6.667a2.5 2.5 0 0 0-2.5 2.5v11.666a2.5 2.5 0 0 0 2.5 2.5h6.666a2.5 2.5 0 0 0 2.5-2.5V4.167a2.5 2.5 0 0 0-2.5-2.5zm.834 14.166a.834.834 0 0 1-.834.834H6.667a.833.833 0 0 1-.834-.834V4.167a.833.833 0 0 1 .834-.834h6.666a.833.833 0 0 1 .834.834v11.666z" />
                                                    </svg>
                                                </a>
                                            @elseif($agent->isTablet($visitor->user_agent))
                                                <a href="#"
                                                   onclick="prompt('USER AGENT','{{ $visitor->user_agent }}');return false;">
                                                    <svg class="w-5 h-5 text-gray-700 fill-current">
                                                        <path d="M14.167 1.667H5.833a2.5 2.5 0 0 0-2.5 2.5v11.666a2.5 2.5 0 0 0 2.5 2.5h8.334a2.5 2.5 0 0 0 2.5-2.5V4.167a2.5 2.5 0 0 0-2.5-2.5zM15 15.833a.834.834 0 0 1-.833.834H5.833A.833.833 0 0 1 5 15.833V4.167a.833.833 0 0 1 .833-.834h8.334a.833.833 0 0 1 .833.834v11.666zm-4.408-2.258a.833.833 0 0 0-.759-.242l-.15.05a.637.637 0 0 0-.15.075l-.125.1a.834.834 0 0 0-.175.275.833.833 0 0 0 .175.909c.083.073.176.135.275.183a.834.834 0 0 0 1.15-.758.7.7 0 0 0-.066-.317.958.958 0 0 0-.175-.275z" />
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="#"
                                                   onclick="prompt('USER AGENT','{{ $visitor->user_agent }}');return false;">
                                                    <svg class="w-5 h-5 text-gray-700 fill-current">
                                                        <path d="M17.5 11.667h-.833V5.833a2.5 2.5 0 0 0-2.5-2.5H5.833a2.5 2.5 0 0 0-2.5 2.5v5.834H2.5a.833.833 0 0 0-.833.833v1.667a2.5 2.5 0 0 0 2.5 2.5h11.666a2.5 2.5 0 0 0 2.5-2.5V12.5a.833.833 0 0 0-.833-.833zM5 5.833A.833.833 0 0 1 5.833 5h8.334a.833.833 0 0 1 .833.833v5.834H5V5.833zm11.667 8.334a.833.833 0 0 1-.834.833H4.167a.833.833 0 0 1-.834-.833v-.834h13.334v.834z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            @if ($agent->is('Windows', $visitor->user_agent))
                                                <svg class="w-5 h-5 ml-1"
                                                     viewBox="0 0 448 512">
                                                    <path fill="currentColor"
                                                          d="M0 93.7l183.6-25.3v177.4H0V93.7zm0 324.6l183.6 25.3V268.4H0v149.9zm203.8 28L448 480V268.4H203.8v177.9zm0-380.6v180.1H448V32L203.8 65.7z" />
                                                </svg>
                                            @elseif($agent->isiOS($visitor->user_agent))
                                                <svg class="w-5 h-5 ml-1"
                                                     viewBox="0 0 384 512">
                                                    <path fill="currentColor"
                                                          d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z" />
                                                </svg>
                                            @elseif($agent->isAndroidOS($visitor->user_agent))
                                                <svg class="w-5 h-5 ml-1"
                                                     viewBox="0 0 576 512">
                                                    <path fill="currentColor"
                                                          d="M420.55 301.93a24 24 0 1124-24 24 24 0 01-24 24m-265.1 0a24 24 0 1124-24 24 24 0 01-24 24m273.7-144.48l47.94-83a10 10 0 10-17.27-10l-48.54 84.07a301.25 301.25 0 00-246.56 0l-48.54-84.07a10 10 0 10-17.27 10l47.94 83C64.53 202.22 8.24 285.55 0 384h576c-8.24-98.45-64.54-181.78-146.85-226.55" />
                                                </svg>
                                            @endif

                                            @if ($agent->is('Firefox', $visitor->user_agent))
                                                <svg class="w-5 h-5 ml-1"
                                                     viewBox="0 0 512 512">
                                                    <path fill="currentColor"
                                                          d="M189.37 152.86zm-58.74-29.37c.16.01.08.01 0 0zm351.42 45.35c-10.61-25.5-32.08-53-48.94-61.73 13.72 26.89 21.67 53.88 24.7 74 0 0 0 .14.05.41-27.58-68.75-74.35-96.47-112.55-156.83-1.93-3.05-3.86-6.11-5.74-9.33-1-1.65-1.86-3.34-2.69-5.05a44.88 44.88 0 01-3.64-9.62.63.63 0 00-.55-.66.9.9 0 00-.46 0l-.12.07-.18.1.1-.14c-54.23 31.77-76.72 87.38-82.5 122.78a130 130 0 00-48.33 12.33 6.25 6.25 0 00-3.09 7.75 6.13 6.13 0 007.79 3.79l.52-.21a117.84 117.84 0 0142.11-11l1.42-.1c2-.12 4-.2 6-.22A122.61 122.61 0 01291 140c.67.2 1.32.42 2 .63 1.89.57 3.76 1.2 5.62 1.87 1.36.5 2.71 1 4.05 1.58 1.09.44 2.18.88 3.25 1.35q2.52 1.13 5 2.35c.75.37 1.5.74 2.25 1.13q2.4 1.26 4.74 2.63 1.51.87 3 1.8a124.89 124.89 0 0142.66 44.13c-13-9.15-36.35-18.19-58.82-14.28 87.74 43.86 64.18 194.9-57.39 189.2a108.43 108.43 0 01-31.74-6.12 139.5 139.5 0 01-7.16-2.93c-1.38-.63-2.76-1.27-4.12-2-29.84-15.34-54.44-44.42-57.51-79.75 0 0 11.25-41.95 80.62-41.95 7.5 0 28.93-20.92 29.33-27-.09-2-42.54-18.87-59.09-35.18-8.85-8.71-13.05-12.91-16.77-16.06a69.58 69.58 0 00-6.31-4.77 113.05 113.05 0 01-.69-59.63c-25.06 11.41-44.55 29.45-58.71 45.37h-.12c-9.67-12.25-9-52.65-8.43-61.08-.12-.53-7.22 3.68-8.15 4.31a178.54 178.54 0 00-23.84 20.43 214 214 0 00-22.77 27.33 205.84 205.84 0 00-32.73 73.9c-.06.27-2.33 10.21-4 22.48q-.42 2.87-.78 5.74c-.57 3.69-1 7.71-1.44 14 0 .24 0 .48-.05.72-.18 2.71-.34 5.41-.49 8.12v1.24c0 134.7 109.21 243.89 243.92 243.89 120.64 0 220.82-87.58 240.43-202.62.41-3.12.74-6.26 1.11-9.41 4.85-41.83-.54-85.79-15.82-122.55z" />
                                                </svg>
                                            @elseif($agent->is('Chrome', $visitor->user_agent))
                                                <svg class="w-5 h-5 ml-1"
                                                     viewBox="0 0 496 512">
                                                    <path fill="currentColor"
                                                          d="M131.5 217.5L55.1 100.1c47.6-59.2 119-91.8 192-92.1 42.3-.3 85.5 10.5 124.8 33.2 43.4 25.2 76.4 61.4 97.4 103L264 133.4c-58.1-3.4-113.4 29.3-132.5 84.1zm32.9 38.5c0 46.2 37.4 83.6 83.6 83.6s83.6-37.4 83.6-83.6-37.4-83.6-83.6-83.6-83.6 37.3-83.6 83.6zm314.9-89.2L339.6 174c37.9 44.3 38.5 108.2 6.6 157.2L234.1 503.6c46.5 2.5 94.4-7.7 137.8-32.9 107.4-62 150.9-192 107.4-303.9zM133.7 303.6L40.4 120.1C14.9 159.1 0 205.9 0 256c0 124 90.8 226.7 209.5 244.9l63.7-124.8c-57.6 10.8-113.2-20.8-139.5-72.5z" />
                                                </svg>
                                            @elseif($agent->is('Opera', $visitor->user_agent))
                                                <svg class="w-5 h-5 ml-1"
                                                     viewBox="0 0 496 512">
                                                    <path fill="currentColor"
                                                          d="M313.9 32.7c-170.2 0-252.6 223.8-147.5 355.1 36.5 45.4 88.6 75.6 147.5 75.6 36.3 0 70.3-11.1 99.4-30.4-43.8 39.2-101.9 63-165.3 63-3.9 0-8 0-11.9-.3C104.6 489.6 0 381.1 0 248 0 111 111 0 248 0h.8c63.1.3 120.7 24.1 164.4 63.1-29-19.4-63.1-30.4-99.3-30.4zm101.8 397.7c-40.9 24.7-90.7 23.6-132-5.8 56.2-20.5 97.7-91.6 97.7-176.6 0-84.7-41.2-155.8-97.4-176.6 41.8-29.2 91.2-30.3 132.9-5 105.9 98.7 105.5 265.7-1.2 364z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 text-center">
                                        @if ($click->country !== 'ZZ')
                                            <a href="#"
                                               onclick="prompt('IP','{{ $click->ip }}');return false;">
                                                <img class="mx-auto"
                                                     width="20"
                                                     height="15"
                                                     src="https://lipis.github.io/flag-icon-css/flags/4x3/{{ strtolower($click->country) }}.svg">
                                            </a>
                                        @else
                                            <a href="#"
                                               onclick="prompt('IP','{{ $click->ip }}');return false;">
                                                <img class="mx-auto"
                                                     width="20"
                                                     height="15"
                                                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Flag_of_None.svg/2000px-Flag_of_None.svg.png"
                                                     alt="">
                                            </a>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        <span>{{ $click->created_at }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No clicks to show</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $clicks->links('admincp.components.pagination') }}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeSection = document.getElementById("sidebar-visitors");

        activeSection.classList.add("text-gray-600", "bg-gray-100");
    </script>
@endsection
