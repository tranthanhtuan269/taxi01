@extends('layouts.site')

@section('title', setting('page_tours_title').' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    @include('partials.page-heading', [
        'kicker' => setting('page_tours_kicker'),
        'title' => setting('page_tours_title'),
        'intro' => setting('page_tours_intro'),
    ])
    <section class="w-full bg-surface pb-space-xl">
        <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter-lg">
                @foreach($routes->whereIn('category', ['tour', 'intercity']) as $routeItem)
                    @include('partials.route-card', ['routeItem' => $routeItem])
                @endforeach
            </div>
            <div class="mt-space-xl">
                @include('partials.booking-widget')
            </div>
        </div>
    </section>
@endsection
