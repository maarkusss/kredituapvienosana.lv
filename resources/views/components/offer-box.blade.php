<div class="pt-2 overflow-hidden transition-all duration-200 bg-white border-t"
     href="{{ route('go', ['lender_id' => $lender->id, 'lender_position' => $position]) }}"
     target="_blank"
     rel="nofollow"
     title="{{ $lender->name }}">
    <div class="flex flex-col items-center justify-between w-full px-2 pb-2 bg-white md:flex-row">
        <div class="flex flex-col items-center justify-center max-w-full px-1 mt-1.5 md:w-40 md:h-20">
            <a class="flex items-center justify-center w-full h-full max-w-full max-h-full profit"
               href="@if (isset($reviewSection)) {{ route('section.deep', ['name' => $reviewSection->route_name, 'deep_name' => $lender->route_name]) }} @else {{ route('go', ['lender_id' => $lender->id, 'lender_position' => $position]) }} @endif"
               aria-label="@lang('Take this offer')"
               @if (isset($_GET['fbpixel'])) onclick="javascript:profit();" @endif
               @if (!isset($reviewSection)) target="_blank"
               rel="nofollow" @endif>
                <img class="object-contain w-full max-w-full max-h-full"
                     src="{{ $lender->image }}"
                     alt="{{ $lender->image_alt_text }}"
                     loading="lazy">
            </a>
        </div>
        @php
            $reviews_array = [];
            $i = 1;
            foreach ($reviews->where('lender_id', $lender->id) as $review) {
                $reviews_array[$i++] = $review->rating;
            }
            if (count($reviews_array) > 0) {
                $average_rating = array_sum($reviews_array) / count($reviews_array);
            } else {
                if ($loop->iteration <= 2) {
                    $average_rating = 5;
                } else {
                    $average_rating = 4;
                }
            }
        @endphp
        <div itemprop="itemReviewed"
             itemscope
             itemtype="https://schema.org/FinancialService">
            <meta itemprop="name"
                  content="{{ $lender->name }}" />
            <meta itemprop="image"
                  content="{{ $lender->image }}" />
            @if ($lender->data->description)
                <meta itemprop="description"
                      content="{{ $lender->data->description }}" />
            @endif
            @if ($lender->max_amount)
                <meta itemprop="priceRange"
                      content="{{ $lender->min_amount }} @lang('€') - {{ $lender->max_amount }} @lang('€')" />
            @endif
            @if ($lender->data->phone)
                <meta itemprop="telephone"
                      content="{{ $lender->data->phone }}" />
            @endif
            @if ($lender->data->address)
                <meta itemprop="address"
                      content="{{ $lender->data->address }}" />
            @endif
            @if (count($reviews_array) > 0)
                <div itemprop="aggregateRating"
                     itemscope
                     itemtype="https://schema.org/AggregateRating">
                    <meta itemprop="reviewCount"
                          content="{{ count($reviews_array) }}" />
                    <meta itemprop="worstRating"
                          content="1" />
                    <meta itemprop="bestRating"
                          content="5" />
                    <meta itemprop="ratingValue"
                          content="{{ $average_rating }}" />
                </div>
            @endif
        </div>
        <div class="flex-1 my-4 md:mx-4 md:my-0">
            <ul class="grid grid-cols-1 gap-2 md:grid-cols-4">
                <li class="flex flex-col items-center justify-center text-sm font-normal text-center text-gray-700 lg:text-md">
                    <div class="flex items-center justify-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($average_rating, 0))
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="#2196f3"
                                     viewBox="0 0 256 256">
                                    <rect width="256"
                                          height="256"
                                          fill="none"></rect>
                                    <path d="M239.2,97.4A16.4,16.4,0,0,0,224.6,86l-59.4-4.1-22-55.5A16.4,16.4,0,0,0,128,16h0a16.4,16.4,0,0,0-15.2,10.4L90.4,82.2,31.4,86A16.5,16.5,0,0,0,16.8,97.4,16.8,16.8,0,0,0,22,115.5l45.4,38.4L53.9,207a18.5,18.5,0,0,0,7,19.6,18,18,0,0,0,20.1.6l46.9-29.7h.2l50.5,31.9a16.1,16.1,0,0,0,8.7,2.6,16.5,16.5,0,0,0,15.8-20.8l-14.3-58.1L234,115.5A16.8,16.8,0,0,0,239.2,97.4Z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="#2196f3"
                                     viewBox="0 0 256 256">
                                    <path d="M132.4,190.7l50.4,32c6.5,4.1,14.5-2,12.6-9.5l-14.6-57.4a8.7,8.7,0,0,1,2.9-8.8l45.2-37.7c5.9-4.9,2.9-14.8-4.8-15.3l-59-3.8a8.3,8.3,0,0,1-7.3-5.4l-22-55.4a8.3,8.3,0,0,0-15.6,0l-22,55.4a8.3,8.3,0,0,1-7.3,5.4L31.9,94c-7.7.5-10.7,10.4-4.8,15.3L72.3,147a8.7,8.7,0,0,1,2.9,8.8L61.7,209c-2.3,9,7.3,16.3,15,11.4l46.9-29.7A8.2,8.2,0,0,1,132.4,190.7Z"
                                          fill="none"
                                          stroke="#2196f3"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="16"></path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                </li>
                <li class="flex flex-col items-center justify-center text-sm font-normal text-center text-gray-700 lg:text-md">
                    {{-- <span class="text-gray-700 md:hiddemd>@lang('Sum')</span> --}}
                    <span class="font-medium ">
                        {{ number_format($lender->min_amount, 0, ' ', ' ') }}
                        -
                        <span class="whitespace-nowrap text-primary">{{ number_format($lender->max_amount, 0, ' ', ' ') }}
                            @lang('€')</span>
                    </span>
                    {{-- <span class="hidden text-gray-700 md:blockmd@lang('Sum')</span> --}}
                </li>
                <li class="flex flex-col items-center justify-center text-sm font-normal text-center text-gray-700 lg:text-md">
                    {{-- <span class="text-gray-700 md:hiddemd>@lang('Term')</span> --}}
                    <span class="font-medium">
                        @lang('up to')
                        @if ($lender->max_term == 360)
                            1 @lang('year')
                        @else
                            {{ round($lender->max_term / 360, 0) }} @lang('years')
                        @endif
                    </span>
                    {{-- <span class="hidden text-gray-700 md:blockmd@lang('Term')</span> --}}
                </li>
                <li class="flex flex-col items-center justify-center text-sm font-normal text-center text-gray-700 lg:text-md">
                    @if (isset($lender->data->work_time_m_f))
                        <p class="pt-1">@lang('Monday - Friday'): {{ $lender->data->work_time_m_f }}</p>
                    @endif
                    @if (isset($lender->data->work_time_sa))
                        <p class="pt-1">@lang('Saturday'): {{ $lender->data->work_time_sa }}</p>
                    @endif
                    @if (isset($lender->data->work_time_su))
                        <p class="pt-1">@lang('Sunday'): {{ $lender->data->work_time_su }}</p>
                    @endif
                </li>
            </ul>
        </div>
        <div class="w-full pr-4 text-center md:w-auto">
            <a class="block w-full px-4 py-2 font-medium text-center text-white transition-all duration-200 rounded-md bg-primary-button text-md profit hover:bg-blue-600 md:w-auto focus:shadow-outline"
               href="{{ route('go', ['lender_id' => $lender->id, 'lender_position' => $position]) }}"
               aria-label="@lang('Take this offer')"
               target="_blank"
               rel="nofollow">
                @lang('Take this offer')
            </a>
        </div>
    </div>
    @if ($lender->data)
        <div class="px-2 pb-4 text-sm text-center">
            {!! $lender->data->apr_example !!}
        </div>
    @endif
</div>
