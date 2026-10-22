<footer class="w-full bg-surface-container-low text-on-surface mt-margin-lg">
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg pt-space-xl pb-space-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter-lg pb-space-xl">
            <div class="flex flex-col gap-space-sm">
                <div class="mb-space-xs">@include('partials.brand')</div>
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ setting('footer_about') }}</p>
                <div class="bg-surface-container p-space-sm rounded-lg flex flex-col gap-space-xs mt-space-xs">
                    <div class="flex items-center gap-space-xs text-secondary">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wide">{{ setting('license_title') }}</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant text-[12px]">{{ setting('license_text') }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-space-sm">
                <h3 class="font-headline-sm text-headline-sm text-primary mb-space-xs">{{ setting('foot_routes_title') }}</h3>
                <ul class="flex flex-col gap-space-xs font-body-sm text-body-sm">
                    @foreach((isset($routes) ? $routes : collect())->where('is_inquiry', false)->take(5) as $routeItem)
                        @php
                            $href = match ($routeItem->category) {
                                'airport' => route('airport'),
                                'tour', 'intercity' => route('tours'),
                                default => route('pricing'),
                            };
                        @endphp
                        <li class="flex items-center gap-space-xs">
                            <span class="material-symbols-outlined text-secondary text-[16px]">chevron_right</span>
                            <a class="text-on-surface-variant hover:text-secondary transition-colors" href="{{ $href }}">{{ $routeItem->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex flex-col gap-space-sm">
                <h3 class="font-headline-sm text-headline-sm text-primary mb-space-xs">{{ setting('foot_promise_title') }}</h3>
                <div class="flex flex-col gap-space-sm font-body-sm text-body-sm">
                    @foreach([1, 2, 3, 4] as $i)
                        <div class="flex items-start gap-space-xs">
                            <span class="material-symbols-outlined text-secondary text-[20px] shrink-0">{{ setting('foot_'.$i.'_icon') }}</span>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">{{ setting('foot_'.$i.'_title') }}</p>
                                <p class="text-on-surface-variant text-[13px]">{{ setting('foot_'.$i.'_body') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-space-sm">
                <h3 class="font-headline-sm text-headline-sm text-primary mb-space-xs">{{ setting('foot_contact_title') }}</h3>
                <div class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
                    <div class="flex items-start gap-space-xs">
                        <span class="material-symbols-outlined text-secondary text-[18px] shrink-0">location_on</span>
                        <p>{{ setting('address') }}</p>
                    </div>
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-secondary text-[18px] shrink-0">call</span>
                        <p class="text-on-surface font-bold">Hotline: {{ setting('phone_display') }} (24/7)</p>
                    </div>
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-secondary text-[18px] shrink-0">mail</span>
                        <p>{{ setting('email') }}</p>
                    </div>
                </div>
                <div class="mt-space-xs">
                    <p class="font-label-sm text-label-sm text-on-surface mb-space-xs">{{ setting('foot_channels_label') }}</p>
                    <div class="flex items-center gap-space-xs flex-wrap">
                        @foreach(array_filter(array_map('trim', explode(',', setting('channels')))) as $channel)
                            <span class="bg-surface-container px-space-xs py-0.5 rounded text-[12px] font-bold text-secondary">{{ $channel }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="mt-space-xs">
                    <p class="font-label-sm text-label-sm text-on-surface mb-space-xs">{{ setting('foot_payments_label') }}</p>
                    <div class="flex items-center gap-space-xs flex-wrap">
                        @foreach(array_filter(array_map('trim', explode(',', setting('payments')))) as $payment)
                            <span class="bg-surface-container-highest px-space-xs py-0.5 rounded text-[11px] font-bold text-on-surface">{{ $payment }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-space-md border-t border-outline-variant/30 flex flex-col md:flex-row items-center justify-between gap-space-sm font-body-sm text-body-sm text-on-surface-variant text-[13px]">
            <p>{{ setting('copyright') }}</p>
            <div class="flex items-center gap-space-md">
                <a class="hover:text-on-surface transition-colors" href="{{ route('page.show', 'dieu-khoan') }}">Điều khoản sử dụng</a>
                <a class="hover:text-on-surface transition-colors" href="{{ route('page.show', 'chinh-sach-bao-mat') }}">Chính sách bảo mật</a>
                <a class="hover:text-on-surface transition-colors" href="{{ route('page.show', 'bao-hiem-hanh-khach') }}">Bảo hiểm hành khách</a>
            </div>
        </div>
    </div>
</footer>
