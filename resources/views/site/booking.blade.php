@extends('layouts.site')

@section('title', setting('page_booking_title').' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    @include('partials.page-heading', [
        'kicker' => setting('page_booking_kicker'),
        'title' => setting('page_booking_title'),
        'intro' => setting('page_booking_intro'),
    ])
    <section class="w-full bg-surface pb-space-xl">
        <div class="max-w-4xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
            @include('partials.booking-widget')
        </div>
    </section>
@endsection
