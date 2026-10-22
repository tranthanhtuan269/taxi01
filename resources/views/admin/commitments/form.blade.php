@extends('layouts.admin')
@section('heading', $item->exists ? 'Sửa cam kết' : 'Thêm cam kết')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid gap-4 max-w-3xl" method="POST" action="{{ $item->exists ? route('admin.commitments.update', $item) : route('admin.commitments.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <label class="text-sm font-semibold">Tiêu đề<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="title" value="{{ old('title', $item->title) }}" required></label>
        <label class="text-sm font-semibold">Icon Material<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="icon" value="{{ old('icon', $item->icon) }}" required></label>
        <label class="text-sm font-semibold">Nội dung<textarea class="mt-1 w-full min-h-28 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="description" required>{{ old('description', $item->description) }}</textarea></label>
        <label class="text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}"></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true))> Đang hiển thị</label>
        <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold w-fit" type="submit">Lưu</button>
    </form>
@endsection
