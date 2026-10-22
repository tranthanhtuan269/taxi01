@extends('layouts.admin')
@section('heading', $routeItem->exists ? 'Sửa tuyến' : 'Thêm tuyến')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid md:grid-cols-2 gap-4" method="POST" action="{{ $routeItem->exists ? route('admin.routes.update', $routeItem) : route('admin.routes.store') }}">
        @csrf
        @if($routeItem->exists) @method('PUT') @endif
        <label class="block text-sm font-semibold md:col-span-2">Tiêu đề<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="title" value="{{ old('title', $routeItem->title) }}" required></label>
        <label class="block text-sm font-semibold">Dòng phụ (cự ly, thời gian)<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="eyebrow" value="{{ old('eyebrow', $routeItem->eyebrow) }}"></label>
        <label class="block text-sm font-semibold">Icon Material<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="icon" value="{{ old('icon', $routeItem->icon ?: 'route') }}" required></label>
        <label class="block text-sm font-semibold md:col-span-2">Mô tả<textarea class="mt-1 w-full min-h-24 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="description">{{ old('description', $routeItem->description) }}</textarea></label>
        <label class="block text-sm font-semibold">Điểm đón khi bấm đặt<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="pickup_default" value="{{ old('pickup_default', $routeItem->pickup_default) }}"></label>
        <label class="block text-sm font-semibold">Điểm đến khi bấm đặt<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="dropoff_default" value="{{ old('dropoff_default', $routeItem->dropoff_default) }}"></label>
        <label class="block text-sm font-semibold">Nhóm
            <select class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="category">
                @foreach(\App\Models\FareRoute::categories() as $value => $label)
                    <option value="{{ $value }}" @selected(old('category', $routeItem->category) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label class="block text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $routeItem->sort_order) }}"></label>
        <label class="block text-sm font-semibold">Nhãn nổi bật<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="featured_label" value="{{ old('featured_label', $routeItem->featured_label) }}"></label>
        <label class="block text-sm font-semibold">Ghi chú thẻ tư vấn<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="inquiry_note" value="{{ old('inquiry_note', $routeItem->inquiry_note) }}"></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $routeItem->is_featured))> Gắn nhãn nổi bật</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_inquiry" value="1" @checked(old('is_inquiry', $routeItem->is_inquiry))> Thẻ gọi tư vấn (không bảng giá)</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $routeItem->is_active ?? true))> Đang hiển thị</label>
        <div class="md:col-span-2" id="priceRows">
            <div class="flex items-center justify-between mb-2">
                <h2 class="font-bold">Các mức giá</h2>
                <button class="text-sm text-sky-700 font-semibold" type="button" id="addPrice">Thêm mức giá</button>
            </div>
            @php $priceRows = old('prices', $routeItem->prices?->map(fn ($price) => ['label' => $price->label, 'price' => $price->price, 'price_suffix' => $price->price_suffix, 'is_highlight' => $price->is_highlight])->all() ?? []); @endphp
            @forelse($priceRows as $index => $row)
                <div class="grid md:grid-cols-12 gap-2 mb-2 price-row">
                    <input class="md:col-span-5 h-11 px-3 rounded-lg ring-1 ring-slate-200" name="prices[{{ $index }}][label]" placeholder="Tên mức giá" value="{{ $row['label'] ?? '' }}">
                    <input class="md:col-span-3 h-11 px-3 rounded-lg ring-1 ring-slate-200" name="prices[{{ $index }}][price]" placeholder="Số tiền" value="{{ $row['price'] ?? '' }}">
                    <input class="md:col-span-2 h-11 px-3 rounded-lg ring-1 ring-slate-200" name="prices[{{ $index }}][price_suffix]" placeholder="/giờ" value="{{ $row['price_suffix'] ?? '' }}">
                    <label class="md:col-span-2 flex items-center gap-2 text-sm"><input type="checkbox" name="prices[{{ $index }}][is_highlight]" value="1" @checked(!empty($row['is_highlight']))> Nổi</label>
                </div>
            @empty
                <div class="grid md:grid-cols-12 gap-2 mb-2 price-row">
                    <input class="md:col-span-5 h-11 px-3 rounded-lg ring-1 ring-slate-200" name="prices[0][label]" placeholder="Tên mức giá">
                    <input class="md:col-span-3 h-11 px-3 rounded-lg ring-1 ring-slate-200" name="prices[0][price]" placeholder="Số tiền">
                    <input class="md:col-span-2 h-11 px-3 rounded-lg ring-1 ring-slate-200" name="prices[0][price_suffix]" placeholder="/giờ">
                    <label class="md:col-span-2 flex items-center gap-2 text-sm"><input type="checkbox" name="prices[0][is_highlight]" value="1"> Nổi</label>
                </div>
            @endforelse
        </div>
        <div class="md:col-span-2 flex gap-3">
            <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold" type="submit">Lưu</button>
            <a class="h-11 px-5 rounded-lg bg-slate-100 inline-flex items-center" href="{{ route('admin.routes.index') }}">Quay lại</a>
        </div>
    </form>
    <template id="priceTemplate">
        <div class="grid md:grid-cols-12 gap-2 mb-2 price-row">
            <input class="md:col-span-5 h-11 px-3 rounded-lg ring-1 ring-slate-200" data-name="label" placeholder="Tên mức giá">
            <input class="md:col-span-3 h-11 px-3 rounded-lg ring-1 ring-slate-200" data-name="price" placeholder="Số tiền">
            <input class="md:col-span-2 h-11 px-3 rounded-lg ring-1 ring-slate-200" data-name="price_suffix" placeholder="/giờ">
            <label class="md:col-span-2 flex items-center gap-2 text-sm"><input type="checkbox" data-name="is_highlight" value="1"> Nổi</label>
        </div>
    </template>
    <script>
        document.getElementById('addPrice')?.addEventListener('click', function () {
            const wrap = document.getElementById('priceRows');
            const index = wrap.querySelectorAll('.price-row').length;
            const node = document.getElementById('priceTemplate').content.cloneNode(true);
            node.querySelectorAll('[data-name]').forEach(function (input) {
                input.name = 'prices[' + index + '][' + input.dataset.name + ']';
            });
            wrap.appendChild(node);
        });
    </script>
@endsection
