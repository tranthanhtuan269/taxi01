@extends('layouts.admin')
@section('heading', 'Cam kết')
@section('content')
    <div class="mb-4"><a class="inline-flex h-10 px-4 items-center rounded-lg bg-[#0f2942] text-white text-sm font-semibold" href="{{ route('admin.commitments.create') }}">Thêm cam kết</a></div>
    <div class="grid gap-3">
        @foreach($items as $item)
            <article class="bg-white rounded-xl shadow-sm p-4 flex justify-between gap-4">
                <div>
                    <p class="font-semibold">{{ $item->title }}</p>
                    <p class="text-sm text-slate-500 mt-1">{{ $item->description }}</p>
                </div>
                <div class="text-sm shrink-0">
                    <a class="text-sky-700 font-semibold" href="{{ route('admin.commitments.edit', $item) }}">Sửa</a>
                    <form method="POST" action="{{ route('admin.commitments.destroy', $item) }}" onsubmit="return confirm('Xóa cam kết này?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 mt-2" type="submit">Xóa</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
@endsection
