@extends('layouts.site')

@section('title', setting('page_offers_title').' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    @include('partials.page-heading', [
        'kicker' => setting('page_offers_kicker'),
        'title' => setting('page_offers_title'),
        'intro' => setting('page_offers_intro'),
    ])
    <section class="w-full bg-surface pb-space-xl">
        <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg grid grid-cols-1 md:grid-cols-2 gap-gutter-lg">
            @foreach($promotions as $promo)
                <article class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm">
                    <div class="flex items-center justify-between gap-space-sm mb-space-sm">
                        <span class="w-10 h-10 rounded-lg bg-surface-container text-secondary flex items-center justify-center">
                            <span class="material-symbols-outlined">{{ $promo->icon }}</span>
                        </span>
                        @if($promo->badge)
                            <span class="px-space-sm py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm">{{ $promo->badge }}</span>
                        @endif
                    </div>
                    <h2 class="font-headline-sm text-headline-sm text-primary mb-space-xs">{{ $promo->title }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">{{ $promo->summary }}</p>
                    @if($promo->detail)
                        <p class="font-body-sm text-body-sm text-on-surface mt-space-sm">{{ $promo->detail }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
    @include('partials.callback-banner')
@endsection
