<section class="w-full bg-surface py-space-xl">
    <div class="max-w-4xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <div class="text-center mb-space-lg">
            <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ setting('faq_kicker') }}</span>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ setting('faq_title') }}</h2>
        </div>
        <div class="space-y-space-sm" id="faqAccordion">
            @foreach($faqs as $faq)
                <div class="bg-surface-container-low rounded-xl overflow-hidden transition-all">
                    <button class="js-faq w-full p-space-md text-left flex items-center justify-between gap-space-sm font-headline-sm text-headline-sm text-primary hover:text-secondary transition-colors" type="button">
                        <span>{{ $faq->question }}</span>
                        <span class="material-symbols-outlined text-[20px] transform transition-transform faq-icon shrink-0">expand_more</span>
                    </button>
                    <div class="faq-content hidden px-space-md pb-space-md font-body-md text-body-md text-on-surface-variant">
                        <p>{!! $faq->answer !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
