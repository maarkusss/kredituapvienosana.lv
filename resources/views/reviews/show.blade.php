@extends('layouts.homepage')

@section('title', $lender->name . ' ' . __('information and reviews'))
@section('description', $lender->data->meta_description)
@section('keywords', $lender->keywords)

@section('content')
    <main>
        <section class="max-w-6xl px-4 mx-auto">
            <div class="py-12">
                @if (isset($lender->data->h1))
                    <h1 class="pb-2 text-4xl font-semibold text-center text-gray-800">{{ $lender->data->h1 }}</h1>
                @endif
                @if (isset($lender->data->h1_description))
                    <p class="text-xl text-center text-gray-500">{{ $lender->data->h1_description }}</p>
                @endif
            </div>
        </section>
        <section class="max-w-6xl px-4 mx-auto">
            <div class="grid grid-cols-1 gap-2 pb-2 mx-auto md:pb-8 md:gap-8 md:grid-cols-3"
                 itemscope
                 itemtype="https://schema.org/FinancialService">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg shadow">
                        <div class="w-1/3 md:w-2/3">
                            <a href="{{ route('go', ['lender_id' => $lender->id, 'lender_position' => $lender->position]) }}"
                               title="{{ $lender->name }}">
                                <img itemprop="image"
                                     src="{{ $lender->image }}"
                                     alt="{{ $lender->image_alt_text }}"
                                     title="{{ $lender->name }}"
                                     loading="lazy">
                            </a>
                        </div>

                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Sum')
                            </p>
                            <p class="text-sm font-bold text-center"
                               itemprop="priceRange">
                                {{ $lender->min_amount }} @lang('€') - {{ $lender->max_amount }} @lang('€')
                            </p>
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Term'):
                            </p>
                            <p class="text-sm font-bold text-center">
                                @if ($lender->min_term == $lender->max_term)
                                    {{ round($lender->max_term / 30, 0) }} @lang('months')
                                @else
                                    @lang('from')
                                    @if ($lender->min_term <= 62)
                                        62 @lang('days')
                                    @elseif($lender->min_term < 360)
                                        {{ round($lender->min_term / 30, 0) }} @lang('months')
                                    @elseif($lender->min_term == 360)
                                        {{ round($lender->min_term / 360, 0) }} @lang('year')
                                    @else
                                        {{ round($lender->min_term / 360, 0) }} @lang('years')
                                    @endif
                                    @lang('up to')
                                    @if ($lender->max_term <= 360)
                                        1 @lang('year')
                                    @else
                                        {{ round($lender->max_term / 360, 0) }} @lang('years')
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Receiving time')
                            </p>
                            <p class="text-sm font-bold text-center">
                                {{ $lender->receiving_time }} @lang('minutes')</p>
                        </div>
                        <div class="w-full pt-4 text-sm text-center md:w-auto">
                            <a class="block w-full px-4 py-2 font-medium text-center text-white transition-all duration-200 rounded-md bg-primary-button text-md profit hover:bg-blue-600 md:w-auto focus:shadow-outline"
                               href="{{ route('go', ['lender_id' => $lender->id, 'lender_position' => $lender->position]) }}"
                               aria-label="@lang('Saņemt aizdevumu')"
                               target="_blank"
                               rel="nofollow">
                                @lang('Saņemt aizdevumu')
                            </a>
                        </div>
                    </div>
                    <meta itemprop="name"
                          content="{{ $lender->name }}" />
                    <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg shadow">
                        <span class="pb-4 font-bold text-center text-md">@lang('Kompānijas dati')</span>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Lender name')
                            </p>
                            <p class="text-sm font-bold text-center">
                                {{ $lender->name ? $lender->name : '-' }}</p>

                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Address')
                            </p>
                            <p class="text-sm font-bold text-center"
                               itemprop="address">
                                {{ $lender->data->address ? $lender->data->address : '-' }}</p>
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Phone number')
                            </p>
                            <p class="text-sm font-bold text-center"
                               itemprop="telephone">
                                {{ $lender->data->phone ? $lender->data->phone : '-' }}</p>
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('E-mail')
                            </p>
                            <p class="text-sm font-bold text-center"
                               itemprop="email">
                                {{ $lender->data->email ? $lender->data->email : '-' }}</p>
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Pirmdiena - Piektdiena')
                            </p>
                            <p class="text-sm font-bold text-center">
                                {{ $lender->data->work_time_m_f ? $lender->data->work_time_m_f : '-' }}</p>
                            <meta itemprop="openingHours"
                                  content="Mo-Fr {{ $lender->data->work_time_m_f }}" />
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Sestdiena')
                            </p>
                            <p class="text-sm font-bold text-center">
                                {{ $lender->data->work_time_sa ? $lender->data->work_time_sa : '-' }}</p>
                            <meta itemprop="openingHours"
                                  content="Sa {{ $lender->data->work_time_sa }}" />
                        </div>
                        <div class="p-[5px]">
                            <p class="text-sm text-center">
                                @lang('Svētdiena')
                            </p>
                            <p class="text-sm font-bold text-center">
                                {{ $lender->data->work_time_su ? $lender->data->work_time_su : '-' }}</p>
                            <meta itemprop="openingHours"
                                  content="Su {{ $lender->data->work_time_su }}" />
                        </div>
                        @if ($lender->data->meta_description)
                            <meta itemprop="description"
                                  content="{{ $lender->data->meta_description }}" />
                        @endif
                        <div class="w-full pt-4 text-sm text-center md:w-auto">
                            <a class="block w-full px-4 py-2 font-medium text-center text-white transition-all duration-200 rounded-md bg-primary-button text-md profit hover:bg-blue-600 md:w-auto focus:shadow-outline"
                               href="{{ route('go', ['lender_id' => $lender->id, 'lender_position' => $lender->position]) }}"
                               aria-label="@lang('Apmeklēt mājaslapu')"
                               target="_blank"
                               rel="nofollow">
                                @lang('Apmeklēt mājaslapu')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="grid col-span-2">
                    @if (isset($lender->data->description))
                        <div class="max-w-full prose">
                            {!! $lender->data->description !!}
                        </div>
                    @endif
                </div>
                <div class="md:col-span-3">
                    <p class="py-6 text-2xl text-center border-t">{{ $lender->name }} @lang('reviews')</p>
                    <div class="flex flex-col w-full py-12">
                        @if (count($reviews) > 0)
                            @php
                                $allRating = 0;
                                
                                for ($i = 1; $i <= $reviews->count(); $i++) {
                                    $allRating = $allRating + $reviews[$i - 1]->rating;
                                }
                                
                                if ($reviews->count() == 0) {
                                    $averageRating = 0;
                                } else {
                                    $averageRating = $allRating / $reviews->count();
                                }
                            @endphp
                            <div itemprop="aggregateRating"
                                 itemscope
                                 itemtype="https://schema.org/AggregateRating">
                                <meta itemprop="reviewCount"
                                      content="{{ $reviews->count() }}" />
                                <meta itemprop="worstRating"
                                      content="1" />
                                <meta itemprop="bestRating"
                                      content="5" />
                                <meta itemprop="ratingValue"
                                      content="{{ $averageRating }}" />
                            </div>
                        @endif
                        @forelse($reviews as $review)
                            <div class="w-full px-3 py-2 text-sm text-gray-800 bg-white border rounded-lg"
                                 itemprop="review"
                                 itemscope
                                 itemtype="https://schema.org/Review">
                                <span itemprop="author"
                                      itemscope
                                      itemtype="https://schema.org/Person">
                                    <span class="block mb-1 text-lg font-medium"
                                          itemprop="name">
                                        {{ $review->name }}
                                    </span>
                                </span>
                                <span class="block mb-1 text-gray-600"
                                      itemprop="datePublished">{{ date('d.m.Y', strtotime($review->created_at)) }}</span>
                                <div itemprop="reviewRating"
                                     itemscope
                                     itemtype="https://schema.org/Rating">
                                    <meta itemprop="worstRating"
                                          content="1" />
                                    <span class="block mb-1">{{ str_repeat('⭐', $review->rating) }}</span>
                                    <meta itemprop="ratingValue"
                                          content="{{ $review->rating }}" />
                                    <meta itemprop="bestRating"
                                          content="5" />
                                </div>
                                <p class="break-words"
                                   itemprop="reviewBody">{{ $review->text }}</p>
                            </div>
                        @empty
                            <span class="text-base font-normal text-gray-800">@lang('No reviews and ratings!')</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        <section class="max-w-6xl px-4 mx-auto">
            <div class="pt-8">
                <p class="py-6 text-2xl text-center border-t">@lang('Add review')</p>
                <form class="grid grid-cols-2 gap-4"
                      action="{{ route('companies.review.create', ['companies_name' => $section->route_name, 'route_name' => $lender->route_name]) }}"
                      method="POST">
                    @csrf
                    <input type="hidden"
                           id="recaptchaResponse"
                           name="recaptcha">
                    <label>
                        <input class="w-full px-5 py-4 text-gray-800 transition-all duration-200 border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-primary-text focus:ring-opacity-50 focus:border-transparent"
                               type="text"
                               placeholder="@lang('Name')"
                               name="name"
                               required />
                    </label>
                    <label>
                        <div class="form-group "
                             name="rating"
                             required>
                            <div class="col-sm-12">
                                <label class="flex flex-col">
                                    <select name="rating"
                                            id="type"
                                            class="w-full px-5 py-4 text-gray-800 transition-all duration-200 border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-primary-text focus:ring-opacity-50 focus:border-transparent">
                                        <option value="0">@lang('Rating')</option>
                                        <option value="1">@lang('1. Star')</option>
                                        <option value="2">@lang('2. Stars')</option>
                                        <option value="3">@lang('3. Stars')</option>
                                        <option value="4">@lang('4. Stars')</option>
                                        <option value="5">@lang('5. Stars')</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </label>
                    <label class="col-span-2">
                        <textarea rows="4"
                                  maxlength="400"
                                  class="w-full px-5 py-4 text-gray-800 transition-all duration-200 border-gray-300 rounded-lg resize-none focus:outline-none focus:ring focus:ring-primary-text focus:ring-opacity-50 focus:border-transparent"
                                  placeholder="@lang('Enter your review text here...')"
                                  name="text"
                                  required></textarea>
                    </label>
                    <input type="hidden"
                           name="lenderID"
                           value="{{ $lender->id }}">
                    <button class="block w-full col-span-2 px-4 py-3 font-medium text-center text-white transition-all duration-200 rounded-lg bg-primary-button lg:text-base hover:bg-blue-600 focus:shadow-outline"
                            type="submit">
                        @lang('Submit review')
                    </button>
                </form>
            </div>
            @if (count($lenders) > 0)
                <div class="py-6 my-12 bg-white border-t rounded-md">
                    <p class="text-2xl text-center">@lang('Other reviews')</p>
                    <div class="grid grid-cols-3 pt-8 pb-2 mx-auto gap6-6 sm:grid-cols-2 lg:grid-cols-6">
                        @foreach ($lenders as $lender)
                            <a class="transition-all duration-200 hover:translate-y-2 hover:drop-shadow-xl"
                               href="{{ route('section.deep', ['name' => $section->route_name, 'deep_name' => $lender->route_name]) }}">
                                <img src="{{ $lender->image }}"
                                     alt="{{ $lender->name }}"
                                     title="{{ $lender->name }}"
                                     loading="lazy">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
<script>
    const onloadCallback = function() {
        console.log("reCAPTCHA has loaded!");
        grecaptcha.reset();
    };
</script>
<script asnyc
        src="https://www.google.com/recaptcha/api.js?render=6LeX0AohAAAAAILSMvrmwVP7rKZJ7UgveLgM5t0f"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LeX0AohAAAAAILSMvrmwVP7rKZJ7UgveLgM5t0f', {
            action: 'homepage'
        }).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });

    // function redirect() {
    //     var url = document.getElementById('test').value
    //     window.location = url + ".html"
    // }
</script>
