@props(['faqs' => $faqs, 'faqPage' => $faqPage])
<section>
    <div class="max-w-6xl px-4 py-6 mx-auto">
        @if ($faqPage == false)
            <h2 class="mb-8 text-3xl font-semibold text-center text-primary-normal">
                @lang('Frequently asked Questions')
            </h2>
            @foreach ($faqs as $key => $faq)
                @php
                    $faq_details = App\Models\Admincp\Faqs\Faqs::where('id', $faq->faq_id)->first();
                @endphp
                <div class="w-full mb-3 overflow-hidden border cursor-pointer rounded-xl">
                    <div class="flex flex-row justify-between p-3 bg-primary-normal" data-id="duplicate_accordion_button">
                        <h3 class="text-xl font-medium text-white">{{ $faq_details->question }}</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-8 h-8" fill="#fcfcfc"
                            viewBox="0 0 256 256">
                            <path fill="none" d="M0 0h256v256H0z" />
                            <path opacity=".2" d="m208 96-80 80-80-80h160z" />
                            <path fill="none" stroke="#fcfcfc" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" d="m208 96-80 80-80-80h160z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-none hidden w-8 h-8" fill="#fcfcfc"
                            viewBox="0 0 256 256">
                            <path fill="none" d="M0 0h256v256H0z" />
                            <path opacity=".2" d="m48 160 80-80 80 80H48z" />
                            <path fill="none" stroke="#fcfcfc" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" d="m48 160 80-80 80 80H48z" />
                        </svg>
                    </div>
                    <div class="hidden px-3 py-3 prose max-w-none">
                        <p>{!! $faq_details->answer !!}</p>
                    </div>
                </div>
            @endforeach
        @else
            <div itemscope itemtype="https://schema.org/FAQPage">
                @foreach ($faqs as $faq)
                    <div class="w-full mb-3 overflow-hidden border-2 border-primary-normal rounded-xl bg-primary-100/30"
                        itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="flex flex-row justify-between p-3 bg-primary-normal"
                            data-id="duplicate_accordion_button">
                            <h2 class="text-xl font-medium text-white" itemprop="name">{{ $faq->question }}
                            </h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-8 h-8" fill="#fcfcfc"
                                viewBox="0 0 256 256">
                                <path fill="none" d="M0 0h256v256H0z" />
                                <path opacity=".2" d="m208 96-80 80-80-80h160z" />
                                <path fill="none" stroke="#fcfcfc" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" d="m208 96-80 80-80-80h160z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="flex-none hidden w-8 h-8" fill="#fcfcfc"
                                viewBox="0 0 256 256">
                                <path fill="none" d="M0 0h256v256H0z" />
                                <path opacity=".2" d="m48 160 80-80 80 80H48z" />
                                <path fill="none" stroke="#fcfcfc" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" d="m48 160 80-80 80 80H48z" />
                            </svg>
                        </div>
                        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"
                            class="hidden px-3 prose max-w-none">
                            <div itemprop="text">{!! $faq->answer !!}</div>
                            @if ($faq->topic)
                                <p>{!! $faq->topic !!}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
<script>
    const duplicateAccordionButtons = document.querySelectorAll('[data-id="duplicate_accordion_button"]');
    duplicateAccordionButtons.forEach(duplicateAccordionButton => {
        duplicateAccordionButton.addEventListener("click", () => {
            const content = duplicateAccordionButton.nextElementSibling;
            content.classList.toggle("hidden");
            const button1 = duplicateAccordionButton.children[1];
            button1.classList.toggle("hidden");
            const button2 = duplicateAccordionButton.children[2];
            button2.classList.toggle("hidden");
        })
    });
</script>
