<a class="flex items-center gap-space-sm" href="{{ route('home') }}">
    @if(logo_url())
        <img class="h-9 w-auto max-w-[9rem] object-contain shrink-0" src="{{ logo_url() }}" alt="">
    @else
        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-primary shrink-0" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M3.5 16.2 5.2 11a2 2 0 0 1 1.9-1.3h9.8a2 2 0 0 1 1.9 1.3l1.7 5.2H3.5Z" fill="#5bb8fe"/>
                <path d="M6 16.2h12" stroke="#fff" stroke-width="1.2" stroke-linecap="round"/>
                <circle cx="7.2" cy="17.6" r="1.35" fill="#ffb95f"/>
                <circle cx="16.8" cy="17.6" r="1.35" fill="#ffb95f"/>
                <path d="M2.8 20.2c2-.9 3.8-.9 5.8 0 1.8-.9 3.6-.9 5.6 0 1.7-.8 3.4-.9 5-.2" stroke="#d1e4ff" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
        </span>
    @endif
    <span class="font-headline-sm text-headline-sm text-primary tracking-tight">{{ setting('brand_primary', 'NhaTrang') }}<span class="text-secondary">{{ setting('brand_accent', 'Ride') }}</span></span>
</a>
