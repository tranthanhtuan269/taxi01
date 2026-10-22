@extends('layouts.admin')
@section('heading', $item->exists ? 'Sửa đánh giá' : 'Thêm đánh giá')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid md:grid-cols-2 gap-4 max-w-3xl" method="POST" action="{{ $item->exists ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <label class="text-sm font-semibold">Tên khách<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="name" value="{{ old('name', $item->name) }}" required></label>
        <label class="text-sm font-semibold">Chữ viết tắt<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="initials" value="{{ old('initials', $item->initials) }}" required></label>
        <label class="text-sm font-semibold md:col-span-2">Nguồn / tuyến<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="subtitle" value="{{ old('subtitle', $item->subtitle) }}"></label>
        <label class="text-sm font-semibold">Số sao<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" min="1" max="5" name="rating" value="{{ old('rating', $item->rating ?: 5) }}" required></label>
        <label class="text-sm font-semibold">Màu avatar
            <select class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="tone">
                @foreach(['secondary' => 'Xanh nhạt', 'muted' => 'Xám', 'cyan' => 'Xanh cyan'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('tone', $item->tone) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label class="text-sm font-semibold md:col-span-2">Nội dung<textarea class="mt-1 w-full min-h-28 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="content" required>{{ old('content', $item->content) }}</textarea></label>
        <label class="text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}"></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true))> Đang hiển thị</label>
        <div class="md:col-span-2"><button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold" type="submit">Lưu</button></div>
    </form>
@endsection
