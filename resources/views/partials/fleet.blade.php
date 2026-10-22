<section class="w-full bg-surface-container-low py-space-xl" id="doi-xe">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <div class="text-center max-w-2xl mx-auto mb-space-xl">
            <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ setting('fleet_kicker') }}</span>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ setting('fleet_title') }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ setting('fleet_body') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter-lg">
            @foreach($vehicles as $vehicle)
                @include('partials.fleet-card', ['vehicle' => $vehicle])
            @endforeach
        </div>
    </div>
</section>
