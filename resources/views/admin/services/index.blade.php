@extends('layouts.admin')
@section('heading', 'Dịch vụ trên form đặt xe')
@section('content')
    <div class="mb-4"><a class="inline-flex h-10 px-4 items-center rounded-lg bg-[#0f2942] text-white text-sm font-semibold" href="{{ route('admin.services.create') }}">Thêm dịch vụ</a></div>
    <div class="bg-white rounded-xl shadow-sm divide-y">
        @foreach($services as $service)
            <div class="p-4 flex items-center justify-between gap-3">
                <div>
                    <p class="font-semibold">{{ $service->label }} <span class="text-slate-400 font-normal">({{ $service->key }})</span></p>
                    <p class="text-sm text-slate-500">{{ $service->pickup_default }} → {{ $service->dropoff_default }}</p>
                </div>
                <div class="text-sm">
                    <a class="text-sky-700 font-semibold" href="{{ route('admin.services.edit', $service) }}">Sửa</a>
                    <form class="inline" method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Xóa dịch vụ này?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-3" type="submit">Xóa</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
