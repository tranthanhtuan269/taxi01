@extends('layouts.admin')
@section('heading', 'Nội dung trang')
@section('content')
    <form class="space-y-6" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <section class="bg-white rounded-xl shadow-sm p-5">
            <h2 class="font-bold text-[#0f2942] mb-4">Logo</h2>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="h-20 w-20 shrink-0 rounded-xl bg-slate-50 ring-1 ring-slate-200 flex items-center justify-center overflow-hidden">
                    @if(logo_url())
                        <img class="max-h-16 max-w-16 object-contain" src="{{ logo_url() }}" alt="Logo hiện tại">
                    @else
                        <span class="text-xs text-slate-400 text-center px-2">Biểu tượng mặc định</span>
                    @endif
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-slate-700" for="logo">Tải logo mới</label>
                    <input class="mt-1 block w-full text-sm" id="logo" name="logo" type="file" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml">
                    <p class="mt-1 text-xs text-slate-500">PNG, JPG, WEBP, GIF hoặc SVG, tối đa 2MB. Logo hiện cạnh tên thương hiệu ở đầu trang và chân trang.</p>
                    @if(logo_url())
                        <label class="mt-3 flex items-center gap-2 text-sm text-slate-700">
                            <input type="checkbox" name="remove_logo" value="1">
                            Gỡ logo, dùng lại biểu tượng xe mặc định
                        </label>
                    @endif
                </div>
            </div>
        </section>
        @foreach(collect($fields)->groupBy('group') as $group => $items)
            <section class="bg-white rounded-xl shadow-sm p-5">
                <h2 class="font-bold text-[#0f2942] mb-4">{{ $group }}</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($items as $field)
                        <label class="block {{ $field['type'] === 'textarea' ? 'md:col-span-2' : '' }}">
                            <span class="text-sm font-semibold text-slate-700">{{ $field['label'] }}</span>
                            @if($field['type'] === 'textarea')
                                <textarea class="mt-1 w-full min-h-24 px-3 py-2 rounded-lg ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-600 outline-none" name="settings[{{ $field['key'] }}]">{{ $stored[$field['key']] ?? '' }}</textarea>
                            @else
                                <input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-600 outline-none" name="settings[{{ $field['key'] }}]" value="{{ $stored[$field['key']] ?? '' }}">
                            @endif
                        </label>
                    @endforeach
                </div>
            </section>
        @endforeach
        <button class="h-12 px-6 rounded-xl bg-[#0f2942] text-white font-bold" type="submit">Lưu nội dung</button>
    </form>
@endsection
