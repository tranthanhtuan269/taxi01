@extends('layouts.admin')
@section('heading', $vehicle->exists ? 'Sửa xe' : 'Thêm xe')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid md:grid-cols-2 gap-4" method="POST" action="{{ $vehicle->exists ? route('admin.vehicles.update', $vehicle) : route('admin.vehicles.store') }}" enctype="multipart/form-data">
        @csrf
        @if($vehicle->exists) @method('PUT') @endif
        <label class="block text-sm font-semibold">Tên xe<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="name" value="{{ old('name', $vehicle->name) }}" required></label>
        <label class="block text-sm font-semibold">Mã (sedan, suv...)<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="code" value="{{ old('code', $vehicle->code) }}" required></label>
        <label class="block text-sm font-semibold md:col-span-2">Dòng xe<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="models" value="{{ old('models', $vehicle->models) }}"></label>
        <label class="block text-sm font-semibold">Sức chứa / tiện ích 1<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="capacity" value="{{ old('capacity', $vehicle->capacity) }}" required></label>
        <label class="block text-sm font-semibold">Icon 1 (Material)<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="capacity_icon" value="{{ old('capacity_icon', $vehicle->capacity_icon ?: 'group') }}" required></label>
        <label class="block text-sm font-semibold">Hành lý / tiện ích 2<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="luggage" value="{{ old('luggage', $vehicle->luggage) }}" required></label>
        <label class="block text-sm font-semibold">Icon 2<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="luggage_icon" value="{{ old('luggage_icon', $vehicle->luggage_icon ?: 'luggage') }}" required></label>
        <label class="block text-sm font-semibold">Điểm nổi bật<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="highlight" value="{{ old('highlight', $vehicle->highlight) }}" required></label>
        <label class="block text-sm font-semibold">Icon điểm nổi bật<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="feature_icon" value="{{ old('feature_icon', $vehicle->feature_icon ?: 'ac_unit') }}" required></label>
        <label class="block text-sm font-semibold">Giá niêm yết "từ" (đồng)<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" min="0" name="price_from" value="{{ old('price_from', $vehicle->price_from) }}" required></label>
        <label class="block text-sm font-semibold">Icon trên form đặt<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="icon" value="{{ old('icon', $vehicle->icon ?: 'directions_car') }}" required></label>
        <label class="block text-sm font-semibold">Nhãn góc ảnh<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="badge" value="{{ old('badge', $vehicle->badge) }}"></label>
        <label class="block text-sm font-semibold">Kiểu nhãn
            <select class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="badge_style">
                @foreach(['primary' => 'Xanh đậm', 'secondary' => 'Xanh biển', 'vip' => 'Vàng VIP'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('badge_style', $vehicle->badge_style) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label class="block text-sm font-semibold md:col-span-2">Ảnh từ đường dẫn<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="image_url" value="{{ old('image_url', $vehicle->image_url) }}"></label>
        <label class="block text-sm font-semibold">Hoặc tải ảnh<input class="mt-1 w-full text-sm" type="file" name="image" accept="image/*"></label>
        <label class="block text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $vehicle->sort_order) }}"></label>
        <div class="md:col-span-2 grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
            @foreach($services as $service)
                <label class="block text-sm font-semibold">Giá {{ $service->label }}
                    <input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" min="0" name="prices[{{ $service->key }}]" value="{{ old('prices.'.$service->key, $prices[$service->key] ?? 0) }}">
                </label>
            @endforeach
        </div>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_vip" value="1" @checked(old('is_vip', $vehicle->is_vip))> Hạng VIP</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $vehicle->is_active ?? true))> Đang hiển thị</label>
        <div class="md:col-span-2 flex gap-3">
            <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold" type="submit">Lưu</button>
            <a class="h-11 px-5 rounded-lg bg-slate-100 inline-flex items-center" href="{{ route('admin.vehicles.index') }}">Quay lại</a>
        </div>
    </form>
@endsection
