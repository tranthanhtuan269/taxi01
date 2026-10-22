@extends('layouts.site')

@section('title', setting('fleet_title').' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    @include('partials.fleet')
@endsection
