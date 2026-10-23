@extends('layouts.admin')
@section('heading', 'Điểm du lịch')
@section('content')
    <div class="mb-4"><a class="inline-flex h-10 px-4 items-center rounded-lg bg-[#0f2942] text-white text-sm font-semibold" href="{{ route('admin.destinations.create') }}">Thêm bài viết</a></div>
    <div class="grid gap-3">
        @forelse($items as $item)
            <article class="bg-white rounded-xl shadow-sm p-4 flex justify-between gap-4">
                <div>
                    <p class="font-semibold">{{ $item->title }}</p>
                    <p class="text-sm text-slate-500 mt-1">{{ $item->excerpt }}</p>
                    <p class="text-xs text-slate-400 mt-2">{{ $item->is_active ? 'Đang hiện' : 'Đang ẩn' }} · /diem-du-lich/{{ $item->slug }}</p>
                </div>
                <div class="text-sm shrink-0">
                    <a class="text-sky-700 font-semibold" href="{{ route('admin.destinations.edit', $item) }}">Sửa</a>
                    <form method="POST" action="{{ route('admin.destinations.destroy', $item) }}" onsubmit="return confirm('Xóa bài viết này?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 mt-2" type="submit">Xóa</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="text-sm text-slate-500">Chưa có bài viết.</p>
        @endforelse
    </div>
@endsection
