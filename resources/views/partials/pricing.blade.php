<section class="w-full bg-surface py-space-xl" id="bang-gia">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-lg gap-space-sm">
            <div>
                <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ setting('pricing_kicker') }}</span>
                <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ setting('pricing_title') }}</h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mt-1">{{ setting('pricing_body') }}</p>
            </div>
            <div class="flex items-center gap-space-xs shrink-0">
                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-primary">
                    <span class="material-symbols-outlined text-[16px] text-secondary">verified_user</span>
                    <span>{{ setting('pricing_badge') }}</span>
                </span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter-lg">
            @foreach($routes->where('is_inquiry', false) as $routeItem)
                @include('partials.route-card', ['routeItem' => $routeItem])
            @endforeach
        </div>
    </div>
</section>
