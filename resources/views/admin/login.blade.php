<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản trị | NhaTrangRide</title>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f8f9ff] flex items-center justify-center p-4" style="font-family: 'Be Vietnam Pro', sans-serif;">
    <form class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <p class="text-sm font-bold text-sky-700 flex items-center gap-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">
            @if(logo_url())
                <img class="h-8 w-auto max-w-[4.5rem] object-contain" src="{{ logo_url() }}" alt="">
            @endif
            {{ setting('brand_primary', 'NhaTrang') }}<span class="text-[#006398]">{{ setting('brand_accent', 'Ride') }}</span>
        </p>
        <h1 class="text-2xl font-extrabold text-[#0f2942] mt-1 mb-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">Đăng nhập quản trị</h1>
        @if($errors->any())
            <p class="mb-4 rounded-lg bg-red-50 text-red-700 px-3 py-2 text-sm">{{ $errors->first() }}</p>
        @endif
        <label class="block text-sm font-semibold mb-1" for="email">Email</label>
        <input class="w-full h-12 px-3 mb-4 rounded-lg ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-600 outline-none" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
        <label class="block text-sm font-semibold mb-1" for="password">Mật khẩu</label>
        <input class="w-full h-12 px-3 mb-4 rounded-lg ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-600 outline-none" id="password" name="password" type="password" required>
        <label class="flex items-center gap-2 text-sm text-slate-600 mb-5">
            <input type="checkbox" name="remember" value="1"> Ghi nhớ đăng nhập
        </label>
        <button class="w-full h-12 rounded-xl bg-[#ffddb8] hover:bg-[#ffb95f] text-[#2a1700] font-bold" type="submit">Vào trang quản trị</button>
        <a class="block text-center text-sm text-sky-700 mt-4" href="{{ route('home') }}">Về trang chủ</a>
    </form>
</body>
</html>
