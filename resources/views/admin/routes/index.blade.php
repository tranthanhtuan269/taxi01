@extends('layouts.admin')
@section('heading', 'Bảng giá tuyến')
@section('content')
    <div class="mb-4"><a class="inline-flex h-10 px-4 items-center rounded-lg bg-[#0f2942] text-white text-sm font-semibold" href="{{ route('admin.routes.create') }}">Thêm tuyến</a></div>
    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left"><tr><th class="p-3">Tuyến</th><th class="p-3">Nhóm</th><th class="p-3">Mức giá</th><th class="p-3">Hiện</th><th class="p-3"></th></tr></thead>
            <tbody>
                @foreach($routes as $item)
                    <tr class="border-t">
                        <td class="p-3 font-semibold">{{ $item->title }}</td>
                        <td class="p-3">{{ \App\Models\FareRoute::categories()[$item->category] ?? $item->category }}</td>
                        <td class="p-3">{{ $item->is_inquiry ? 'Thẻ tư vấn' : $item->prices->count().' mức' }}</td>
                        <td class="p-3">{{ $item->is_active ? 'Có' : 'Ẩn' }}</td>
                        <td class="p-3 text-right">
                            <a class="text-sky-700 font-semibold" href="{{ route('admin.routes.edit', $item) }}">Sửa</a>
                            <form class="inline" method="POST" action="{{ route('admin.routes.destroy', $item) }}" onsubmit="return confirm('Xóa tuyến này?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 ml-3" type="submit">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
