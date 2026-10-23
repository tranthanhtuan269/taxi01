@extends('layouts.site')

@section('title', $destination->title.' | '.setting('brand_primary').setting('brand_accent'))

@section('content')
    <article class="w-full bg-surface py-space-xl">
        <div class="max-w-3xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
            <a class="inline-flex items-center gap-1 font-label-sm text-label-sm text-secondary mb-space-md" href="{{ route('home') }}#diem-du-lich">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Các điểm du lịch
            </a>
            @if($destination->eyebrow)
                <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wide">{{ $destination->eyebrow }}</p>
            @endif
            <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ $destination->title }}</h1>
            @if($destination->displayImage())
                <img class="mt-space-md w-full h-56 sm:h-80 object-cover rounded-xl" alt="{{ $destination->title }}" src="{{ $destination->displayImage() }}">
            @endif
            <p class="font-body-md text-body-md text-on-surface mt-space-sm">{{ $destination->excerpt }}</p>
            <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-space-sm mt-space-lg">
                @foreach(preg_split("/\r\n|\n|\r/", $destination->body) as $paragraph)
                    @if(trim($paragraph) !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
            <div class="mt-space-xl flex flex-col sm:flex-row gap-space-sm">
                <button class="js-fill-route px-space-lg py-3.5 bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed font-headline-sm text-headline-sm rounded-xl font-bold" type="button" data-pickup="{{ $destination->pickup_default }}" data-dropoff="{{ $destination->dropoff_default }}">Đặt xe đến {{ $destination->title }}</button>
                <a class="px-space-lg py-3.5 bg-surface-container hover:bg-secondary hover:text-on-secondary text-secondary font-label-md text-label-md rounded-xl text-center transition-colors" href="tel:{{ setting('phone_tel') }}">Gọi {{ setting('phone_display') }}</a>
            </div>
        </div>
    </article>
@endsection
