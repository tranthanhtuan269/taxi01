<section class="relative w-full overflow-hidden bg-gradient-to-b from-surface-container-high via-surface-container-low to-surface pb-space-xl">
    <div class="pointer-events-none absolute -top-24 -left-20 w-96 h-96 rounded-full bg-secondary-fixed opacity-40 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/3 -right-24 w-[28rem] h-[28rem] rounded-full bg-tertiary-fixed-dim opacity-30 blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg pt-space-lg lg:pt-space-xl">
        <div class="flex flex-wrap items-center gap-space-xs md:gap-space-sm mb-space-md">
            <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-lowest shadow-sm text-primary font-label-sm text-label-sm">
                <span class="text-on-tertiary-container font-extrabold text-[14px]">★ {{ setting('rating_score') }}</span>
                <span class="text-on-surface-variant font-normal">{{ setting('rating_text') }}</span>
            </span>
            <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-lowest shadow-sm text-secondary font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-[16px] text-secondary">flight_land</span>
                <span>{{ setting('badge_delay') }}</span>
            </span>
            <span class="hidden sm:inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-lowest shadow-sm text-primary font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-[16px] text-secondary">verified</span>
                <span>{{ setting('badge_fixed') }}</span>
            </span>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start mb-space-xl">
            <div class="lg:col-span-5 flex flex-col justify-center">
                <div class="inline-flex items-center gap-2 mb-space-xs text-secondary font-label-md text-label-md">
                    <span class="h-2 w-2 rounded-full bg-secondary animate-pulse"></span>
                    <span>{{ setting('hero_kicker') }}</span>
                </div>
                <h1 class="font-display text-display text-primary tracking-tight leading-tight mb-space-sm">{{ setting('hero_title') }}</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-space-md leading-relaxed">{!! setting('hero_body') !!}</p>
                <div class="grid grid-cols-3 gap-space-sm py-space-sm bg-surface-container-lowest/80 backdrop-blur-md rounded-xl p-space-sm shadow-sm mb-space-md">
                    <div class="flex flex-col">
                        <span class="font-headline-md text-headline-md text-secondary">{{ setting('stat_1_value') }}</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">{{ setting('stat_1_label') }}</span>
                    </div>
                    <div class="flex flex-col border-l border-outline-variant/30 pl-space-sm">
                        <span class="font-headline-md text-headline-md text-primary">{{ setting('stat_2_value') }}</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">{{ setting('stat_2_label') }}</span>
                    </div>
                    <div class="flex flex-col border-l border-outline-variant/30 pl-space-sm">
                        <span class="font-headline-md text-headline-md text-on-tertiary-container">{{ setting('stat_3_value') }}</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">{{ setting('stat_3_label') }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-space-sm p-space-sm bg-surface-container rounded-xl">
                    <div class="flex items-center gap-space-sm">
                        <div class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-on-secondary shrink-0">
                            <span class="material-symbols-outlined text-[20px]">phone_in_talk</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-label-sm text-label-sm text-on-surface-variant">{{ setting('dispatch_label') }}</span>
                            <a class="font-headline-sm text-headline-sm text-primary hover:text-secondary transition-colors" href="tel:{{ setting('phone_tel') }}">{{ setting('phone_display') }}</a>
                        </div>
                    </div>
                    @include('partials.contact-links', ['variant' => 'hero'])
                </div>
            </div>
            <div class="lg:col-span-7">
                @include('partials.booking-widget')
            </div>
        </div>
    </div>
</section>
