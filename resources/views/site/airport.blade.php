@extends('layouts.site')

@section('title', setting('page_airport_title').' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    @include('partials.page-heading', [
        'kicker' => setting('page_airport_kicker'),
        'title' => setting('page_airport_title'),
        'intro' => setting('page_airport_intro'),
    ])
    <section class="w-full bg-surface pb-space-xl">
        <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">
            <div class="lg:col-span-5 flex flex-col gap-gutter">
                @foreach($routes->where('category', 'airport') as $routeItem)
                    @include('partials.route-card', ['routeItem' => $routeItem])
                @endforeach
            </div>
            <div class="lg:col-span-7">
                @include('partials.booking-widget')
            </div>
        </div>
    </section>
    @include('partials.faq')
@endsection
