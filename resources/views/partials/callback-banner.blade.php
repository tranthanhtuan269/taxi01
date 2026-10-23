<section class="w-full bg-gradient-to-r from-primary via-primary-container to-secondary text-on-primary py-space-xl relative overflow-hidden">
    <div class="pointer-events-none absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-secondary-container opacity-20 blur-2xl"></div>
    <div class="max-w-7xl mx-auto px-margin md:px-margin-md lg:px-margin-lg relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-center">
            <div class="lg:col-span-7">
                <span class="px-space-sm py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm font-bold inline-block mb-space-xs">{{ setting('banner_badge') }}</span>
                <h2 class="font-headline-lg text-headline-lg text-on-primary tracking-tight mb-space-xs">{{ setting('banner_title') }}</h2>
                <p class="font-body-lg text-body-lg text-inverse-on-surface max-w-xl mb-space-md">{{ setting('banner_body') }}</p>
                <div class="flex flex-wrap items-center gap-space-md">
                    <a class="px-space-lg py-3.5 bg-tertiary-fixed hover:bg-tertiary-fixed-dim text-on-tertiary-fixed font-headline-sm text-headline-sm rounded-xl transition-all shadow-md flex items-center gap-2 font-bold" href="tel:{{ setting('phone_tel') }}">
                        <span class="material-symbols-outlined text-[22px]">phone_enabled</span>
                        <span>GỌI ĐẶT XE: {{ setting('phone_display') }}</span>
                    </a>
                    @include('partials.contact-links', ['variant' => 'banner'])
                </div>
            </div>
            <div class="lg:col-span-5 bg-surface-container-lowest text-on-surface p-space-lg rounded-xl shadow-xl">
                <h3 class="font-headline-sm text-headline-sm text-primary mb-1">{{ setting('callback_title') }}</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">{{ setting('callback_body') }}</p>
                @if(session('callback_success'))
                    <p class="mb-space-sm rounded-lg bg-secondary-fixed text-on-secondary-container px-space-sm py-space-xs font-body-sm text-body-sm">{{ session('callback_success') }}</p>
                @endif
                @if($errors->callback->any())
                    <p class="mb-space-sm rounded-lg bg-error-container text-on-error-container px-space-sm py-space-xs font-body-sm text-body-sm">{{ $errors->callback->first() }}</p>
                @endif
                <form class="flex flex-col gap-space-sm" method="POST" action="{{ route('callback.store') }}">
                    @csrf
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-1" for="callbackPhone">Số điện thoại của bạn:</label>
                        <input class="w-full h-12 px-space-sm bg-surface-container-low rounded-lg font-body-sm text-body-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none" id="callbackPhone" name="callback_phone" placeholder="Nhập số điện thoại (VD: 0794 466 093)" required type="tel" value="{{ old('callback_phone') }}">
                    </div>
                    <div>
                        <span class="block font-label-sm text-label-sm text-on-surface mb-1">Liên hệ qua</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach(contact_channels() as $channel)
                                <label class="cursor-pointer">
                                    <input class="sr-only peer" name="contact_channel" type="radio" value="{{ $channel['key'] }}" @checked(old('contact_channel', 'zalo') === $channel['key'])>
                                    <span class="inline-flex px-3 py-1.5 rounded-full bg-surface-container-low font-label-sm text-label-sm text-on-surface-variant peer-checked:bg-secondary peer-checked:text-on-secondary transition-colors">{{ $channel['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-1" for="callbackNote">Tuyến đường hoặc nhu cầu:</label>
                        <input class="w-full h-12 px-space-sm bg-surface-container-low rounded-lg font-body-sm text-body-sm ring-1 ring-outline-variant/40 focus:ring-2 focus:ring-secondary focus:outline-none" id="callbackNote" name="note" placeholder="VD: Đón Cam Ranh ngày mai 14h, xe 7 chỗ..." type="text" value="{{ old('note') }}">
                    </div>
                    <button class="w-full h-12 bg-secondary hover:bg-on-secondary-container text-on-secondary font-label-md text-label-md rounded-lg transition-colors flex items-center justify-center gap-2 mt-1" type="submit">
                        <span class="material-symbols-outlined text-[18px]">ring_volume</span>
                        <span>{{ setting('callback_button') }}</span>
                    </button>
                    <p class="text-[11px] text-center text-on-surface-variant">{{ setting('callback_privacy') }}</p>
                </form>
            </div>
        </div>
    </div>
</section>
