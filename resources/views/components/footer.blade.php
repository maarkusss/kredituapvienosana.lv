@php
    $sections = App\Models\Admincp\Sections\Sections::where('lang', app()->getLocale())
        ->where('active', true)
        ->where('parent_section_id', null)
        ->where('type', '!=', 'home')
        ->where('display_in_the_header', false)
        ->orderBy('order')
        ->get();
@endphp

<footer class="bg-primary-normal">
    <section class="max-w-6xl py-2 mx-auto">
        <div class="px-4 border-b">
            @if (count($sections) > 0)
                <div class="flex items-center justify-center my-4">
                    @foreach ($sections as $section)
                        <a class="px-2 text-sm text-left text-white hover:underline"
                            href="{{ route('section', ['name' => $section->route_name]) }}">
                            {{ $section->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
        <p class="p-4 text-sm text-white">@lang('footerText')</p>
        <div class="flex items-center justify-between px-4 py-3 text-sm">
            <div class="flex flex-col items-start justify-start text-sm text-white">
                <p> © kredituapvienosana.lv 2015 - {{ date('Y') }}
                <p class="flex">@lang('Developed by')
                    <a class="px-1 hover:underline" href="https://goodday.group/" target="_blank" title="Goodday Group">
                        goodday.group
                    </a>
                </p>
                </p>
            </div>
            <ul class="flex flex-row items-start justify-end">
                {{-- Facebook --}}
                <li class="px-2"><a href="https://www.facebook.com/kredituapvienosana" target="_blank"
                        title="kredituapvienosana.lv"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="#fff" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <circle cx="128" cy="128" r="96" fill="none" stroke="#fff"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></circle>
                            <path d="M168,88H152a23.9,23.9,0,0,0-24,24V224" fill="none" stroke="#fff"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></path>
                            <line x1="96" y1="144" x2="160" y2="144" fill="none"
                                stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                            </line>
                        </svg></a></li>
                {{-- Twitter --}}
                <li class="px-2"><a href="https://twitter.com/apvienosana" target="_blank"
                        title="kredituapvienosana.lv"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="#fff" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <path
                                d="M128,88c0-22,18.5-40.3,40.5-40a40,40,0,0,1,36.2,24H240l-32.3,32.3A127.9,127.9,0,0,1,80,224c-32,0-40-12-40-12s32-12,48-36c0,0-64-32-48-120,0,0,40,40,88,48Z"
                                fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="24"></path>
                        </svg></a></li>
                {{-- Instagram --}}
                <li class="px-2"><a href="https://instagram.com/apvienosana" target="_blank"
                        title="kredituapvienosana.lv"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="#fff" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <circle cx="128" cy="128" r="34" fill="none" stroke="#fff"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></circle>
                            <rect x="32" y="32" width="192" height="192" rx="48"
                                fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="24"></rect>
                            <circle cx="180" cy="76" r="16"></circle>
                        </svg></a></li>
            </ul>
        </div>
    </section>
</footer>
