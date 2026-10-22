@php
    $badgeClass = match ($vehicle->badge_style) {
        'secondary' => 'bg-secondary text-on-secondary',
        'vip' => 'bg-on-tertiary-container text-on-tertiary',
        default => 'bg-primary/80 backdrop-blur-sm text-on-primary',
    };
    $accent = $vehicle->is_vip ? 'text-on-tertiary-container' : 'text-secondary';
@endphp
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col">
    <div class="h-48 w-full bg-surface-container overflow-hidden relative">
        @if($vehicle->displayImage())
            <img class="w-full h-full object-cover" alt="{{ $vehicle->name }}" src="{{ $vehicle->displayImage() }}">
        @endif
        @if($vehicle->badge)
            <span class="absolute bottom-2 left-2 {{ $badgeClass }} text-[12px] font-label-sm px-2 py-0.5 rounded">{{ $vehicle->badge }}</span>
        @endif
    </div>
    <div class="p-space-md flex flex-col flex-1 justify-between">
        <div>
            <h3 class="font-headline-sm text-headline-sm text-primary mb-1">{{ $vehicle->name }}</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">{{ $vehicle->models }}</p>
            <div class="space-y-1.5 mb-space-md text-[13px] text-on-surface">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] {{ $accent }}">{{ $vehicle->capacity_icon }}</span>
                    <span>{{ $vehicle->capacity }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] {{ $accent }}">{{ $vehicle->luggage_icon }}</span>
                    <span>{{ $vehicle->luggage }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] {{ $accent }}">{{ $vehicle->feature_icon }}</span>
                    <span>{{ $vehicle->highlight }}</span>
                </div>
            </div>
        </div>
        <div class="pt-space-xs border-t border-surface-container flex items-center justify-between">
            <div>
                <span class="text-[11px] text-on-surface-variant block">Giá từ</span>
                <span class="font-headline-sm text-headline-sm {{ $accent }}">{{ money($vehicle->price_from) }}</span>
            </div>
            <button class="js-select-vehicle px-space-sm py-1.5 rounded-lg font-label-sm text-label-sm transition-colors {{ $vehicle->is_vip ? 'bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed font-bold' : 'bg-surface-container hover:bg-secondary hover:text-on-secondary text-primary' }}" type="button" data-vehicle="{{ $vehicle->code }}">
                Chọn xe này
            </button>
        </div>
    </div>
</div>
