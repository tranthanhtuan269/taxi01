<section class="w-full bg-surface-container-low py-space-xl">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-lg">
            <div>
                <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ setting('reviews_kicker') }}</span>
                <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ setting('reviews_title') }}</h2>
            </div>
            <div class="mt-2 md:mt-0 flex items-center gap-1 text-on-surface">
                <span class="font-headline-sm text-headline-sm text-primary">{{ setting('reviews_score') }}</span>
                <div class="flex text-on-tertiary-container">
                    @for($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                    @endfor
                </div>
                <span class="text-on-surface-variant font-body-sm text-body-sm">{{ setting('reviews_source') }}</span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-lg">
            @foreach($testimonials as $item)
                @php
                    $tone = match ($item->tone) {
                        'muted' => 'bg-surface-container text-primary',
                        'cyan' => 'bg-secondary-container/50 text-secondary',
                        default => 'bg-secondary-fixed text-secondary',
                    };
                @endphp
                <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex text-on-tertiary-container mb-space-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' {{ $i <= $item->rating ? 1 : 0 }};">star</span>
                            @endfor
                        </div>
                        <p class="font-body-md text-body-md text-on-surface leading-relaxed mb-space-md italic">"{{ $item->content }}"</p>
                    </div>
                    <div class="flex items-center gap-space-sm pt-space-xs border-t border-surface-container">
                        <div class="w-10 h-10 rounded-full {{ $tone }} flex items-center justify-center font-bold">{{ $item->initials }}</div>
                        <div>
                            <h4 class="font-label-md text-label-md text-primary">{{ $item->name }}</h4>
                            <p class="text-[12px] text-on-surface-variant">{{ $item->subtitle }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
