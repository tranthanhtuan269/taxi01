<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản trị') | NhaTrangRide</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: "Be Vietnam Pro", sans-serif; }
        h1, h2, .nav-brand { font-family: "Plus Jakarta Sans", sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen lg:grid lg:grid-cols-[260px_1fr]">
        <aside class="bg-[#0f2942] text-white lg:min-h-screen">
            <div class="px-5 py-5 flex items-center justify-between">
                <a class="nav-brand font-extrabold tracking-tight" href="{{ route('admin.dashboard') }}">NhaTrang<span class="text-sky-300">Ride</span></a>
                <a class="text-xs text-sky-200 lg:hidden" href="{{ route('home') }}">Xem trang</a>
            </div>
            <nav class="px-3 pb-6 flex lg:flex-col gap-1 overflow-x-auto">
                @foreach([
                    ['admin.dashboard', 'Tổng quan', 'admin.dashboard'],
                    ['admin.settings.edit', 'Nội dung trang', 'admin.settings.*'],
                    ['admin.bookings.index', 'Đơn đặt xe', 'admin.bookings.*'],
                    ['admin.callbacks.index', 'Yêu cầu gọi lại', 'admin.callbacks.*'],
                    ['admin.vehicles.index', 'Đội xe', 'admin.vehicles.*'],
                    ['admin.routes.index', 'Bảng giá', 'admin.routes.*'],
                    ['admin.services.index', 'Dịch vụ đặt xe', 'admin.services.*'],
                    ['admin.promotions.index', 'Ưu đãi', 'admin.promotions.*'],
                    ['admin.testimonials.index', 'Đánh giá', 'admin.testimonials.*'],
                    ['admin.faqs.index', 'Câu hỏi', 'admin.faqs.*'],
                    ['admin.commitments.index', 'Cam kết', 'admin.commitments.*'],
                    ['admin.pages.index', 'Trang tĩnh', 'admin.pages.*'],
                ] as [$href, $label, $match])
                    <a href="{{ route($href) }}" class="whitespace-nowrap rounded-lg px-3 py-2 text-sm {{ request()->routeIs($match) ? 'bg-white/15 font-semibold' : 'text-slate-200 hover:bg-white/10' }}">{{ $label }}</a>
                @endforeach
            </nav>
        </aside>
        <div>
            <header class="bg-white border-b border-slate-200 px-5 py-3 flex items-center justify-between gap-3">
                <h1 class="text-lg font-bold text-[#0f2942]">@yield('heading')</h1>
                <div class="flex items-center gap-3 text-sm">
                    <a class="text-sky-700 font-semibold" href="{{ route('home') }}" target="_blank">Xem website</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="text-slate-500 hover:text-slate-900" type="submit">Đăng xuất</button>
                    </form>
                </div>
            </header>
            <main class="p-5">
                @if(session('status'))
                    <p class="mb-4 rounded-lg bg-emerald-50 text-emerald-800 px-4 py-3 text-sm">{{ session('status') }}</p>
                @endif
                @if($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 text-red-800 px-4 py-3 text-sm">{{ $errors->first() }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
