@extends('layouts.admin')
@section('heading', 'Đội xe')
@section('content')
    <div class="mb-4"><a class="inline-flex h-10 px-4 items-center rounded-lg bg-[#0f2942] text-white text-sm font-semibold" href="{{ route('admin.vehicles.create') }}">Thêm xe</a></div>
    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left"><tr><th class="p-3">Xe</th><th class="p-3">Mã</th><th class="p-3">Giá từ</th><th class="p-3">Hiện</th><th class="p-3"></th></tr></thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                    <tr class="border-t">
                        <td class="p-3 font-semibold">{{ $vehicle->name }}</td>
                        <td class="p-3">{{ $vehicle->code }}</td>
                        <td class="p-3">{{ money($vehicle->price_from) }}</td>
                        <td class="p-3">{{ $vehicle->is_active ? 'Có' : 'Ẩn' }}</td>
                        <td class="p-3 text-right whitespace-nowrap">
                            <a class="text-sky-700 font-semibold" href="{{ route('admin.vehicles.edit', $vehicle) }}">Sửa</a>
                            <form class="inline" method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Xóa xe này?')">
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
