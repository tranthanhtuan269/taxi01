<section class="w-full bg-surface py-space-xl">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-center">
            <div class="lg:col-span-5">
                <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ setting('why_kicker') }}</span>
                <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1 mb-space-sm">{{ setting('why_title') }}</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-space-md leading-relaxed">{{ setting('why_body') }}</p>
                <div class="bg-surface-container p-space-md rounded-xl flex items-center gap-space-sm">
                    <span class="material-symbols-outlined text-secondary text-[36px]">support_agent</span>
                    <div>
                        <h4 class="font-label-lg text-label-lg text-primary">{{ setting('why_card_title') }}</h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">{{ setting('why_card_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                @foreach($commitments as $item)
                    <div class="bg-surface-container-low p-space-md rounded-xl hover:bg-surface-container transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-highest text-secondary flex items-center justify-center mb-space-sm">
                            <span class="material-symbols-outlined text-[24px]">{{ $item->icon }}</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-primary mb-1">{{ $item->title }}</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
