@extends('layouts.site')

@section('title', $page->title.' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    <section class="w-full bg-surface py-space-xl">
        <div class="max-w-3xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
            <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mb-space-md">{{ $page->title }}</h1>
            <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-space-sm">
                @foreach(preg_split("/\r\n|\n|\r/", $page->body) as $paragraph)
                    @if(trim($paragraph) !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
