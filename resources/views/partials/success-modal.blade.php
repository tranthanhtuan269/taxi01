@php $success = session('booking_success'); @endphp
<div class="fixed inset-0 z-50 bg-primary/70 backdrop-blur-sm items-center justify-center p-space-md {{ $success ? 'flex' : 'hidden' }}" id="bookingSuccessModal">
    <div class="bg-surface-container-lowest max-w-md w-full rounded-2xl p-space-lg shadow-2xl flex flex-col items-center text-center">
        <div class="w-16 h-16 rounded-full bg-secondary-fixed text-secondary flex items-center justify-center mb-space-sm">
            <span class="material-symbols-outlined text-[36px]">check_circle</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-primary mb-1">{{ setting('modal_title') }}</h3>
        <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">{{ setting('modal_body') }}</p>
        <div class="w-full bg-surface-container-low p-space-sm rounded-lg mb-space-md text-left text-[13px] space-y-1">
            <div class="flex justify-between gap-3">
                <span class="text-on-surface-variant">Tuyến đường:</span>
                <span class="font-semibold text-primary text-right" id="modalRoute">{{ $success['route'] ?? '' }}</span>
            </div>
            <div class="flex justify-between gap-3">
                <span class="text-on-surface-variant">Hạng xe:</span>
                <span class="font-semibold text-primary" id="modalVehicle">{{ $success['vehicle'] ?? '' }}</span>
            </div>
            <div class="flex justify-between gap-3">
                <span class="text-on-surface-variant">Giá tạm tính:</span>
                <span class="font-bold text-secondary" id="modalPrice">{{ $success['price'] ?? '' }}</span>
            </div>
        </div>
        <button class="w-full py-3 bg-secondary text-on-secondary rounded-lg font-label-md text-label-md hover:bg-on-secondary-container transition-colors" id="closeSuccessModal" type="button">
            Đã Hiểu & Đóng Cửa Sổ
        </button>
    </div>
</div>
