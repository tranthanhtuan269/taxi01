@extends('layouts.site')

@section('title', setting('pricing_title').' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    @include('partials.pricing')
    <section class="w-full bg-surface pb-space-xl">
        <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
            @include('partials.booking-widget')
        </div>
    </section>
@endsection
