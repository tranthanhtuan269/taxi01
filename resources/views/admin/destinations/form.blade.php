@extends('layouts.admin')
@section('heading', $item->exists ? 'Sửa bài viết điểm du lịch' : 'Thêm bài viết điểm du lịch')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid gap-4 max-w-3xl" method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.destinations.update', $item) : route('admin.destinations.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <label class="text-sm font-semibold">Tiêu đề<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="title" value="{{ old('title', $item->title) }}" required></label>
        <label class="text-sm font-semibold">Đường dẫn (để trống sẽ tự tạo)<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="slug" value="{{ old('slug', $item->slug) }}" placeholder="vinwonders-nha-trang"></label>
        <label class="text-sm font-semibold">Dòng phụ<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="eyebrow" value="{{ old('eyebrow', $item->eyebrow) }}" placeholder="Đảo Hòn Tre • Cáp treo vượt biển"></label>
        <label class="text-sm font-semibold">Ảnh bài viết
            @if($item->displayImage())
                <img class="mt-1 mb-2 h-36 w-full object-cover rounded-lg" src="{{ $item->displayImage() }}" alt="">
            @endif
            <input class="mt-1 w-full text-sm" type="file" name="image" accept="image/*">
        </label>
        <label class="text-sm font-semibold">Đoạn mở đầu trên trang chủ<textarea class="mt-1 w-full min-h-24 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="excerpt" required maxlength="500">{{ old('excerpt', $item->excerpt) }}</textarea></label>
        <label class="text-sm font-semibold">Nội dung bài viết<textarea class="mt-1 w-full min-h-56 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="body" required>{{ old('body', $item->body) }}</textarea></label>
        <div class="grid md:grid-cols-2 gap-4">
            <label class="text-sm font-semibold">Biểu tượng Material<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="icon" value="{{ old('icon', $item->icon) }}" required></label>
            <label class="text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}"></label>
            <label class="text-sm font-semibold">Điểm đón khi bấm đặt xe<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="pickup_default" value="{{ old('pickup_default', $item->pickup_default) }}"></label>
            <label class="text-sm font-semibold">Điểm đến khi bấm đặt xe<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="dropoff_default" value="{{ old('dropoff_default', $item->dropoff_default) }}"></label>
        </div>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true))> Đang hiển thị</label>
        <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold w-fit" type="submit">Lưu</button>
    </form>
@endsection
