@php
    $rail = array_merge([
        [
            'key' => 'phone',
            'label' => 'Gọi điện',
            'url' => 'tel:'.setting('phone_tel'),
            'external' => false,
            'color' => 'bg-tertiary-fixed text-on-tertiary-fixed',
        ],
    ], array_map(function (array $channel) {
        $colors = [
            'zalo' => 'bg-[#0068FF] text-white',
            'kakao' => 'bg-[#FEE500] text-[#3C1E1E]',
            'whatsapp' => 'bg-[#25D366] text-white',
            'wechat' => 'bg-[#07C160] text-white',
        ];

        return [
            'key' => $channel['key'],
            'label' => $channel['label'],
            'url' => $channel['url'],
            'external' => true,
            'color' => $colors[$channel['key']] ?? 'bg-secondary text-on-secondary',
        ];
    }, contact_channels()));
@endphp
<aside class="pointer-events-none fixed right-3 bottom-[20px] z-40 flex flex-col gap-2 bg-transparent print:hidden" aria-label="Liên hệ nhanh">
    @foreach($rail as $item)
        @php
            $hasLink = $item['url'] !== '';
            $tag = $hasLink ? 'a' : 'button';
        @endphp
        <{{ $tag }}
            class="pointer-events-auto group relative flex h-11 w-11 items-center justify-center rounded-full shadow-md transition-transform hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-secondary {{ $item['color'] }}"
            @if($hasLink)
                href="{{ $item['url'] }}"
                @if($item['external']) target="_blank" rel="noopener" @endif
            @else
                type="button"
                data-copy-phone="{{ setting('phone_display') }}"
            @endif
            aria-label="{{ $item['label'] }} {{ setting('phone_display') }}"
        >
            <span class="pointer-events-none absolute right-full mr-2 hidden whitespace-nowrap rounded-lg bg-primary px-2 py-1 text-[12px] font-semibold text-on-primary shadow-sm group-hover:block group-focus-visible:block">{{ $item['label'] }}</span>
            <span class="pointer-events-none absolute right-full mr-2 hidden whitespace-nowrap rounded-lg bg-primary px-2 py-1 text-[12px] font-semibold text-on-primary shadow-sm" data-copied>Đã sao chép số</span>
            @if($item['key'] === 'phone')
                <span class="material-symbols-outlined text-[22px]">call</span>
            @else
                <span class="font-headline-sm text-[13px] font-extrabold leading-none">{{ ['zalo' => 'Z', 'kakao' => 'K', 'whatsapp' => 'WA', 'wechat' => '微'][$item['key']] ?? mb_substr($item['label'], 0, 1) }}</span>
            @endif
        </{{ $tag }}>
    @endforeach
</aside>
<script>
    document.querySelectorAll('[data-copy-phone]').forEach(function (button) {
        button.addEventListener('click', function () {
            const phone = button.getAttribute('data-copy-phone') || '';
            const note = button.querySelector('[data-copied]');
            const show = function () {
                if (!note) return;
                note.classList.remove('hidden');
                note.classList.add('block');
                setTimeout(function () {
                    note.classList.add('hidden');
                    note.classList.remove('block');
                }, 1800);
            };
            if (navigator.clipboard && phone) {
                navigator.clipboard.writeText(phone).then(show).catch(show);
            } else {
                show();
            }
        });
    });
</script>
