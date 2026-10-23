@php
    $variant = $variant ?? 'footer';
    $classes = [
        'header' => 'inline-flex items-center px-2.5 py-1 rounded-full bg-surface-container-high hover:bg-surface-container-highest font-label-sm text-[13px] text-on-surface transition-colors',
        'footer' => 'inline-flex items-center bg-surface-container px-space-xs py-1 rounded text-[12px] font-bold text-secondary hover:bg-secondary hover:text-on-secondary transition-colors',
        'hero' => 'inline-flex items-center px-space-sm py-space-xs bg-surface-container-lowest rounded-lg font-label-sm text-label-sm text-secondary hover:bg-secondary hover:text-on-secondary transition-colors shadow-sm',
        'banner' => 'inline-flex items-center gap-1.5 px-space-sm py-2.5 bg-surface-container-lowest/15 hover:bg-surface-container-lowest/25 text-on-primary rounded-xl font-label-sm text-label-sm backdrop-blur-md transition-colors',
        'menu' => 'px-space-sm py-space-sm rounded-lg font-label-md text-label-md text-secondary',
    ];
    $class = $classes[$variant] ?? $classes['footer'];
@endphp
<div class="{{ $variant === 'menu' ? 'flex flex-col gap-1' : 'flex flex-wrap items-center gap-2' }}">
    @foreach(contact_channels() as $channel)
        @if($channel['url'] !== '')
            <a class="{{ $class }}" href="{{ $channel['url'] }}" target="_blank" rel="noopener">{{ $channel['label'] }}</a>
        @else
            <span class="{{ $class }} opacity-80" title="Thêm đường dẫn trong Nội dung trang">{{ $channel['label'] }}</span>
        @endif
    @endforeach
</div>
