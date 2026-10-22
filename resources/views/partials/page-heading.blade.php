<section class="w-full bg-gradient-to-b from-surface-container-high via-surface-container-low to-surface pt-space-lg pb-space-md">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ $kicker }}</span>
        <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ $title }}</h1>
        @if(!empty($intro))
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mt-2">{{ $intro }}</p>
        @endif
    </div>
</section>
