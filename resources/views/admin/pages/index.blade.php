@extends('layouts.admin')
@section('heading', 'Trang tĩnh')
@section('content')
    <div class="mb-4"><a class="inline-flex h-10 px-4 items-center rounded-lg bg-[#0f2942] text-white text-sm font-semibold" href="{{ route('admin.pages.create') }}">Thêm trang</a></div>
    <div class="bg-white rounded-xl shadow-sm divide-y">
        @foreach($items as $item)
            <div class="p-4 flex items-center justify-between gap-3">
                <div>
                    <p class="font-semibold">{{ $item->title }}</p>
                    <a class="text-sm text-sky-700" href="{{ route('page.show', $item->slug) }}" target="_blank">/trang/{{ $item->slug }}</a>
                </div>
                <div class="text-sm">
                    <a class="text-sky-700 font-semibold" href="{{ route('admin.pages.edit', $item) }}">Sửa</a>
                    <form class="inline" method="POST" action="{{ route('admin.pages.destroy', $item) }}" onsubmit="return confirm('Xóa trang này?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-3" type="submit">Xóa</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
