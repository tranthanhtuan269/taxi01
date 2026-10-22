@if($routeItem->is_inquiry)
    <div class="bg-gradient-to-br from-primary-container to-primary text-on-primary rounded-xl p-space-lg shadow-sm flex flex-col justify-between">
        <div>
            <div class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center mb-space-sm">
                <span class="material-symbols-outlined text-[24px] text-secondary-fixed">{{ $routeItem->icon }}</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-on-primary mb-space-xs">{{ $routeItem->title }}</h3>
            <p class="font-body-sm text-body-sm text-inverse-on-surface mb-space-md leading-relaxed">{{ $routeItem->description }}</p>
        </div>
        <div class="flex flex-col gap-space-xs">
            <a class="w-full py-space-sm bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed rounded-lg font-label-md text-label-md font-bold text-center transition-colors" href="tel:{{ setting('phone_tel') }}">
                Gọi Tư Vấn Giá Riêng: {{ setting('phone_display') }}
            </a>
            @if($routeItem->inquiry_note)
                <span class="text-[12px] text-center text-inverse-on-surface/80">{{ $routeItem->inquiry_note }}</span>
            @endif
        </div>
    </div>
@else
    <div class="relative bg-surface-container-lowest rounded-xl p-space-lg shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between overflow-hidden">
        @if($routeItem->is_featured && $routeItem->featured_label)
            <div class="absolute top-0 right-0 bg-secondary text-on-secondary px-space-sm py-1 rounded-bl-xl font-label-sm text-label-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">local_fire_department</span>
                <span>{{ $routeItem->featured_label }}</span>
            </div>
        @endif
        <div>
            <div class="flex items-center gap-2 mb-space-xs text-secondary font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-[18px]">{{ $routeItem->icon }}</span>
                <span>{{ $routeItem->eyebrow }}</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-primary mb-space-xs {{ $routeItem->is_featured ? 'pr-24' : '' }}">{{ $routeItem->title }}</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">{{ $routeItem->description }}</p>
            <div class="space-y-2 bg-surface-container-low p-space-sm rounded-lg mb-space-md">
                @foreach($routeItem->prices as $price)
                    <div class="flex items-center justify-between {{ $loop->first ? '' : 'border-t border-outline-variant/20 pt-2' }} {{ $price->is_highlight ? 'text-on-tertiary-container' : '' }}">
                        <span class="font-body-sm text-body-sm {{ $price->is_highlight ? '' : 'text-on-surface' }}">{{ $price->label }}</span>
                        <span class="{{ $price->price_suffix ? 'font-label-md text-label-md text-on-surface-variant' : 'font-headline-sm text-headline-sm' }} {{ $price->is_highlight ? '' : 'text-primary' }}">{{ $price->formatted() }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="js-fill-route w-full py-space-sm bg-surface-container hover:bg-secondary hover:text-on-secondary rounded-lg font-label-md text-label-md text-secondary transition-colors text-center" type="button" data-pickup="{{ $routeItem->pickup_default }}" data-dropoff="{{ $routeItem->dropoff_default }}">
            Đặt Tuyến Này Ngay
        </button>
    </div>
@endif
