@php
    $activeService = old('service_key', request('service', $services->first()->key ?? 'airport'));
    $serviceModel = $services->firstWhere('key', $activeService) ?? $services->first();
    $activeVehicle = old('vehicle_code', request('vehicle', $vehicles->first()->code ?? ''));
    $tripMode = old('trip_mode', 'oneway');
    $pickupValue = old('pickup', request('pickup', $serviceModel->pickup_default ?? ''));
    $dropoffValue = old('dropoff', request('dropoff', $serviceModel->dropoff_default ?? ''));
    $discount = (int) setting('roundtrip_discount', '10');
    $selected = $vehicles->firstWhere('code', $activeVehicle) ?? $vehicles->first();
    $unit = $selected ? $selected->priceFor($activeService) : 0;
    $shownPrice = $tripMode === 'roundtrip' ? (int) round($unit * 2 * (100 - $discount) / 100) : $unit;
@endphp
<div class="bg-surface-container-lowest rounded-xl shadow-xl overflow-hidden" id="bookingWidget">
    <div class="grid grid-cols-2 md:grid-cols-4 bg-surface-container-low p-1.5 gap-1" id="bookingTabContainer">
        @foreach($services as $service)
            <button class="booking-tab flex items-center justify-center gap-1.5 py-space-sm px-space-xs rounded-lg font-label-sm text-label-sm transition-all {{ $service->key === $activeService ? 'bg-surface-container-lowest text-secondary shadow-sm active' : 'text-on-surface-variant hover:text-on-surface' }}"
                    data-key="{{ $service->key }}"
                    data-pickup="{{ $service->pickup_default }}"
                    data-dropoff="{{ $service->dropoff_default }}"
                    type="button">
                <span class="material-symbols-outlined text-[18px]">{{ $service->icon }}</span>
                <span class="truncate">{{ $service->label }}</span>
            </button>
        @endforeach
    </div>
    <form class="p-space-md md:p-space-lg flex flex-col gap-space-md" id="bookingForm" method="POST" action="{{ route('booking.store') }}">
        @csrf
        <input type="hidden" name="service_key" id="serviceKey" value="{{ $activeService }}">
        @if($errors->any())
            <div class="rounded-lg bg-error-container text-on-error-container px-space-sm py-space-xs font-body-sm text-body-sm">{{ $errors->first() }}</div>
        @endif
        <div class="flex items-center justify-between pb-space-xs border-b border-surface-container">
            <div class="flex items-center gap-space-xs bg-surface-container-low p-1 rounded-full">
                <label class="flex items-center cursor-pointer">
                    <input class="sr-only peer" name="trip_mode" type="radio" value="oneway" @checked($tripMode !== 'roundtrip')>
                    <span class="px-space-md py-1 text-label-sm font-label-sm rounded-full peer-checked:bg-secondary peer-checked:text-on-secondary text-on-surface-variant transition-colors">Một chiều</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input class="sr-only peer" name="trip_mode" type="radio" value="roundtrip" @checked($tripMode === 'roundtrip')>
                    <span class="px-space-md py-1 text-label-sm font-label-sm rounded-full peer-checked:bg-secondary peer-checked:text-on-secondary text-on-surface-variant transition-colors flex items-center gap-1">
                        <span>Khứ hồi</span>
                        <span class="text-[10px] px-1.5 py-0.2 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-bold">-{{ $discount }}%</span>
                    </span>
                </label>
            </div>
            <div class="hidden sm:flex items-center gap-1 text-[13px] text-on-surface-variant">
                <span class="material-symbols-outlined text-secondary text-[16px]">schedule</span>
                <span>Tài xế nhận lệnh: <strong class="text-primary font-semibold">{{ setting('dispatch_speed') }}</strong></span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-sm">
            <div class="flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-surface flex items-center gap-1" for="pickupLocation">
                    <span class="material-symbols-outlined text-[16px] text-secondary">location_on</span>
                    <span>Điểm đón khách</span>
                </label>
                <div class="relative">
                    <input class="w-full h-12 pl-space-sm pr-space-lg bg-surface-container-lowest text-on-surface rounded-lg font-body-sm text-body-sm shadow-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none transition-all" id="pickupLocation" name="pickup" required type="text" value="{{ $pickupValue }}">
                    <button class="js-swap absolute right-2 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-secondary p-1" title="Đổi vị trí" type="button">
                        <span class="material-symbols-outlined text-[18px]">swap_horiz</span>
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-surface flex items-center gap-1" for="dropoffLocation">
                    <span class="material-symbols-outlined text-[16px] text-on-tertiary-container">flag</span>
                    <span>Điểm đến</span>
                </label>
                <input class="w-full h-12 px-space-sm bg-surface-container-lowest text-on-surface rounded-lg font-body-sm text-body-sm shadow-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none transition-all" id="dropoffLocation" name="dropoff" required type="text" value="{{ $dropoffValue }}">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-sm">
            <div class="flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-surface" for="pickupDate">Ngày đón</label>
                <input class="h-12 px-space-sm bg-surface-container-lowest text-on-surface rounded-lg font-body-sm text-body-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none" id="pickupDate" name="pickup_date" required type="date" min="{{ now()->toDateString() }}" value="{{ old('pickup_date', now()->toDateString()) }}">
            </div>
            <div class="flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-surface" for="pickupTime">Giờ hạ cánh / Đón</label>
                <input class="h-12 px-space-sm bg-surface-container-lowest text-on-surface rounded-lg font-body-sm text-body-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none" id="pickupTime" name="pickup_time" required type="time" value="{{ old('pickup_time', '09:30') }}">
            </div>
            <div class="flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-surface flex items-center justify-between" for="flightNumber">
                    <span>Mã chuyến bay</span>
                    <span class="text-[11px] text-on-surface-variant font-normal">Theo dõi delay</span>
                </label>
                <input class="h-12 px-space-sm uppercase bg-surface-container-lowest text-on-surface rounded-lg font-body-sm text-body-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none" id="flightNumber" name="flight_number" placeholder="VN1344, VJ778..." type="text" value="{{ old('flight_number') }}">
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <span class="font-label-sm text-label-sm text-on-surface">Chọn hạng xe phục vụ:</span>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                @foreach($vehicles as $vehicle)
                    @php $chipPrice = $vehicle->priceFor($activeService); @endphp
                    <label class="vehicle-option relative cursor-pointer">
                        <input class="sr-only peer" name="vehicle_code" type="radio" value="{{ $vehicle->code }}" data-prices='@json($vehicle->prices->pluck('price', 'service_key'))' data-fallback="{{ $vehicle->price_from }}" @checked($vehicle->code === $activeVehicle)>
                        <div class="p-space-xs rounded-xl bg-surface-container-low peer-checked:bg-secondary-fixed peer-checked:ring-2 peer-checked:ring-secondary transition-all flex flex-col justify-between h-full">
                            <div class="flex items-center justify-between">
                                <span class="material-symbols-outlined text-[20px] {{ $vehicle->is_vip ? 'text-on-tertiary-container' : 'text-primary' }}">{{ $vehicle->icon }}</span>
                                <span class="font-label-sm text-label-sm font-bold {{ $vehicle->is_vip ? 'text-on-tertiary-container' : 'text-secondary' }}" data-price-for="{{ $vehicle->code }}">{{ number_format($chipPrice / 1000, 0, ',', '.') }}k</span>
                            </div>
                            <div class="mt-2">
                                <p class="font-label-sm text-label-sm text-primary leading-tight">{{ $vehicle->badge ?: $vehicle->name }}</p>
                                <p class="text-[11px] text-on-surface-variant">{{ \Illuminate\Support\Str::before($vehicle->models, ',') }}</p>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm items-center">
            <div class="sm:col-span-7 flex flex-col gap-1">
                <label class="font-label-sm text-label-sm text-on-surface" for="contactPhone">Số điện thoại / Zalo nhận xác nhận:</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[14px] font-bold">+84</span>
                    <input class="w-full h-12 pl-12 pr-space-sm bg-surface-container-lowest text-on-surface rounded-lg font-body-sm text-body-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none" id="contactPhone" name="phone" placeholder="0905 123 456" required type="tel" value="{{ old('phone') }}">
                </div>
            </div>
            <div class="sm:col-span-5 flex flex-col justify-end">
                <div class="h-12 bg-surface-container px-space-sm rounded-lg flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-on-surface-variant uppercase">Ước tính trọn gói:</span>
                        <span class="font-headline-sm text-headline-sm text-primary leading-none" id="priceDisplay">{{ money($shownPrice) }}</span>
                    </div>
                    <span class="text-[11px] font-label-sm text-on-secondary-container bg-secondary-container/50 px-2 py-0.5 rounded-full">{{ setting('price_note') }}</span>
                </div>
            </div>
        </div>
        <button class="w-full h-14 bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed font-headline-sm text-headline-sm rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 group cursor-pointer" type="submit">
            <span>XÁC NHẬN ĐẶT XE NGAY</span>
            <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
        </button>
        <div class="flex items-center justify-center gap-space-md text-[12px] text-on-surface-variant text-center flex-wrap">
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-secondary text-[16px]">check_circle</span><span>{{ setting('guarantee_1') }}</span></span>
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-secondary text-[16px]">support_agent</span><span>{{ setting('guarantee_2') }}</span></span>
        </div>
    </form>
</div>
