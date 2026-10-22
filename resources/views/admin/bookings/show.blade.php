@extends('layouts.admin')
@section('heading', 'Chi tiết đơn #'.$booking->id)
@section('content')
    <div class="bg-white rounded-xl shadow-sm p-5 max-w-2xl">
        <dl class="grid grid-cols-2 gap-3 text-sm mb-6">
            <div><dt class="text-slate-500">Dịch vụ</dt><dd class="font-semibold">{{ $booking->service_key }}</dd></div>
            <div><dt class="text-slate-500">Chiều</dt><dd class="font-semibold">{{ $booking->trip_mode === 'roundtrip' ? 'Khứ hồi' : 'Một chiều' }}</dd></div>
            <div class="col-span-2"><dt class="text-slate-500">Tuyến</dt><dd class="font-semibold">{{ $booking->pickup }} → {{ $booking->dropoff }}</dd></div>
            <div><dt class="text-slate-500">Ngày đón</dt><dd class="font-semibold">{{ optional($booking->pickup_date)->format('d/m/Y') }} {{ $booking->pickup_time }}</dd></div>
            <div><dt class="text-slate-500">Chuyến bay</dt><dd class="font-semibold">{{ $booking->flight_number ?: '—' }}</dd></div>
            <div><dt class="text-slate-500">Xe</dt><dd class="font-semibold">{{ $booking->vehicle_name }}</dd></div>
            <div><dt class="text-slate-500">Điện thoại</dt><dd class="font-semibold">{{ $booking->phone }}</dd></div>
            <div><dt class="text-slate-500">Giá tạm tính</dt><dd class="font-semibold text-[#006398]">{{ money($booking->estimated_price) }}</dd></div>
        </dl>
        <form class="grid gap-3" method="POST" action="{{ route('admin.bookings.update', $booking) }}">
            @csrf @method('PUT')
            <label class="text-sm font-semibold">Trạng thái
                <select class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="status">
                    @foreach(\App\Models\Booking::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected($booking->status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            <label class="text-sm font-semibold">Ghi chú nội bộ<textarea class="mt-1 w-full min-h-24 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="admin_note">{{ old('admin_note', $booking->admin_note) }}</textarea></label>
            <div class="flex gap-3">
                <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold" type="submit">Cập nhật</button>
                <a class="h-11 px-5 rounded-lg bg-slate-100 inline-flex items-center" href="{{ route('admin.bookings.index') }}">Danh sách</a>
            </div>
        </form>
        <form class="mt-4" method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" onsubmit="return confirm('Xóa đơn này?')">
            @csrf @method('DELETE')
            <button class="text-sm text-red-600" type="submit">Xóa đơn</button>
        </form>
    </div>
@endsection
