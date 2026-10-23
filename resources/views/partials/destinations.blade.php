<section class="w-full bg-surface-container-low py-space-xl" id="diem-du-lich">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg">
        <div class="text-center max-w-2xl mx-auto mb-space-xl">
            <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ setting('destinations_kicker', 'ĐIỂM DU LỊCH PHỔ BIẾN') }}</span>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">{{ setting('destinations_title', 'Các Điểm Du Lịch Được Đặt Xe Nhiều Nhất') }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ setting('destinations_body', 'Một vài gợi ý lộ trình ngắn quanh Nha Trang và Cam Ranh. Đọc bài rồi đặt xe thẳng tới điểm đó.') }}</p>
        </div>
        <div class="grid grid-cols-4 gap-2 sm:gap-3 lg:gap-gutter">
            @foreach($destinations->take(4) as $destination)
                <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col min-w-0">
                    <a class="block h-24 sm:h-36 lg:h-44 bg-surface-container overflow-hidden" href="{{ route('destinations.show', $destination) }}">
                        @if($destination->displayImage())
                            <img class="w-full h-full object-cover" alt="{{ $destination->title }}" src="{{ $destination->displayImage() }}">
                        @endif
                    </a>
                    <div class="p-2 sm:p-space-sm lg:p-space-md flex flex-col flex-1 min-w-0">
                        @if($destination->eyebrow)
                            <p class="hidden sm:block font-label-sm text-[11px] text-secondary uppercase tracking-wide truncate">{{ $destination->eyebrow }}</p>
                        @endif
                        <h3 class="font-headline-sm text-[13px] sm:text-base lg:text-headline-sm text-primary leading-snug mt-0.5 line-clamp-2">
                            <a class="hover:text-secondary transition-colors" href="{{ route('destinations.show', $destination) }}">{{ $destination->title }}</a>
                        </h3>
                        <p class="hidden lg:block font-body-sm text-body-sm text-on-surface-variant mt-space-xs line-clamp-3 flex-1">{{ $destination->excerpt }}</p>
                        <div class="mt-2 lg:mt-space-sm flex flex-col gap-1.5">
                            <a class="py-1.5 lg:py-space-sm bg-surface-container hover:bg-secondary hover:text-on-secondary rounded-lg font-label-sm text-[12px] lg:text-label-sm text-secondary text-center transition-colors" href="{{ route('destinations.show', $destination) }}">Đọc bài</a>
                            <button class="js-fill-route py-1.5 lg:py-space-sm bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed rounded-lg font-label-sm text-[12px] lg:text-label-sm font-bold transition-colors" type="button" data-pickup="{{ $destination->pickup_default }}" data-dropoff="{{ $destination->dropoff_default }}">Đặt xe</button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
