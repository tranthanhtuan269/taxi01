@extends('layouts.admin')
@section('heading', $service->exists ? 'Sửa dịch vụ' : 'Thêm dịch vụ')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid md:grid-cols-2 gap-4 max-w-3xl" method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
        @csrf
        @if($service->exists) @method('PUT') @endif
        <label class="text-sm font-semibold">Mã<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="key" value="{{ old('key', $service->key) }}" required></label>
        <label class="text-sm font-semibold">Tên tab<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="label" value="{{ old('label', $service->label) }}" required></label>
        <label class="text-sm font-semibold">Icon<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="icon" value="{{ old('icon', $service->icon) }}" required></label>
        <label class="text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}"></label>
        <label class="text-sm font-semibold md:col-span-2">Điểm đón mặc định<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="pickup_default" value="{{ old('pickup_default', $service->pickup_default) }}" required></label>
        <label class="text-sm font-semibold md:col-span-2">Điểm đến mặc định<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="dropoff_default" value="{{ old('dropoff_default', $service->dropoff_default) }}" required></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active ?? true))> Đang hiển thị</label>
        <div class="md:col-span-2"><button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold" type="submit">Lưu</button></div>
    </form>
@endsection
