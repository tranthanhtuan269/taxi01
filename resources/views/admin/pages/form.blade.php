@extends('layouts.admin')
@section('heading', $item->exists ? 'Sửa trang' : 'Thêm trang')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid gap-4 max-w-3xl" method="POST" action="{{ $item->exists ? route('admin.pages.update', $item) : route('admin.pages.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <label class="text-sm font-semibold">Tiêu đề<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="title" value="{{ old('title', $item->title) }}" required></label>
        <label class="text-sm font-semibold">Đường dẫn<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="slug" value="{{ old('slug', $item->slug) }}" placeholder="tu-dong-neu-de-trong"></label>
        <label class="text-sm font-semibold">Nội dung<textarea class="mt-1 w-full min-h-48 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="body" required>{{ old('body', $item->body) }}</textarea></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true))> Đang hiển thị</label>
        <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold w-fit" type="submit">Lưu</button>
    </form>
@endsection
