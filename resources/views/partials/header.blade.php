@php
    $nav = [
        ['route' => 'home', 'label' => 'Trang chủ'],
        ['route' => 'pricing', 'label' => 'Bảng giá cước'],
        ['route' => 'airport', 'label' => 'Sân bay Cam Ranh'],
        ['route' => 'tours', 'label' => 'Tour trong ngày'],
        ['route' => 'fleet', 'label' => 'Đội xe'],
        ['route' => 'offers', 'label' => 'Ưu đãi'],
    ];
@endphp
<header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
    <div class="h-20 max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg flex items-center justify-between gap-space-md">
        <div class="flex items-center gap-space-md shrink-0">
            @include('partials.brand')
        </div>
        <nav class="hidden xl:flex items-center gap-space-xs">
            @foreach($nav as $item)
                <a href="{{ route($item['route']) }}"
                   @class([
                       'px-space-sm py-space-xs font-label-md text-label-md rounded-lg transition-colors',
                       'bg-surface-container-high text-primary shadow-sm' => request()->routeIs($item['route']),
                       'text-on-surface-variant hover:text-on-surface' => ! request()->routeIs($item['route']),
                   ])>{{ $item['label'] }}</a>
            @endforeach
        </nav>
        <div class="flex items-center gap-space-sm shrink-0">
            <div class="relative hidden sm:inline-block text-left">
                <select class="appearance-none bg-surface-container-low font-label-sm text-label-sm text-on-surface py-space-xs pl-space-sm pr-space-lg rounded-full cursor-pointer hover:bg-surface-container transition-colors focus:outline-none" aria-label="Ngôn ngữ">
                    <option value="vi" selected>VN</option>
                    <option value="en">EN</option>
                    <option value="ru">RU</option>
                    <option value="kr">KR</option>
                </select>
                <span class="material-symbols-outlined pointer-events-none absolute right-space-xs top-1/2 -translate-y-1/2 text-on-surface-variant text-[16px]">expand_more</span>
            </div>
            <a class="hidden lg:flex items-center gap-space-xs bg-surface-container-low hover:bg-surface-container px-space-sm py-space-xs rounded-full transition-colors" href="tel:{{ setting('phone_tel') }}">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                </span>
                <span class="material-symbols-outlined text-secondary text-[18px]">call</span>
                <span class="font-label-sm text-label-sm text-on-surface font-bold">{{ setting('phone_display') }}</span>
            </a>
            <a class="hidden sm:flex items-center gap-space-xs bg-surface-container-high hover:bg-surface-container-highest px-space-sm py-space-xs rounded-full transition-colors" href="{{ setting('zalo_url') }}" target="_blank" rel="noopener">
                <span class="material-symbols-outlined text-secondary text-[18px]">chat</span>
                <span class="font-label-sm text-label-sm text-on-surface">Zalo 24/7</span>
            </a>
            <a class="inline-flex items-center justify-center bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed font-label-md text-label-md px-space-md py-space-sm rounded-lg transition-colors shadow-sm font-bold" href="{{ route('booking') }}">Đặt xe ngay</a>
            <a class="w-8 h-8 rounded-full bg-primary flex items-center justify-center" href="{{ route('admin.login') }}" title="Quản trị">
                <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
            </a>
            <button class="xl:hidden w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center" id="menuToggle" type="button" aria-label="Mở menu">
                <span class="material-symbols-outlined text-primary">menu</span>
            </button>
        </div>
    </div>
    <div class="hidden xl:hidden border-t border-outline-variant/30 bg-surface-container-lowest" id="mobileNav">
        <nav class="max-w-7xl mx-auto px-margin py-space-sm flex flex-col gap-1">
            @foreach($nav as $item)
                <a class="px-space-sm py-space-sm rounded-lg font-label-md text-label-md {{ request()->routeIs($item['route']) ? 'bg-surface-container-high text-primary' : 'text-on-surface' }}" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
            @endforeach
            <a class="px-space-sm py-space-sm font-label-md text-label-md text-secondary" href="tel:{{ setting('phone_tel') }}">Gọi {{ setting('phone_display') }}</a>
        </nav>
    </div>
</header>
