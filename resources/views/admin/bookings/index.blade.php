@extends('layouts.admin')
@section('heading', 'Đơn đặt xe')
@section('content')
    <form class="mb-4 flex flex-wrap gap-2" method="GET">
        <input class="h-11 px-3 rounded-lg ring-1 ring-slate-200" name="q" value="{{ request('q') }}" placeholder="Số điện thoại, điểm đón, điểm đến">
        <select class="h-11 px-3 rounded-lg ring-1 ring-slate-200" name="status">
            <option value="">Mọi trạng thái</option>
            @foreach(\App\Models\Booking::STATUSES as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="h-11 px-4 rounded-lg bg-[#0f2942] text-white" type="submit">Lọc</button>
    </form>
    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left"><tr><th class="p-3">Ngày đặt</th><th class="p-3">Tuyến</th><th class="p-3">Khách</th><th class="p-3">Xe</th><th class="p-3">Liên hệ</th><th class="p-3">Giá</th><th class="p-3">Trạng thái</th></tr></thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="border-t">
                        <td class="p-3 whitespace-nowrap"><a class="text-sky-700 font-semibold" href="{{ route('admin.bookings.show', $booking) }}">{{ optional($booking->pickup_date)->format('d/m/Y') }} {{ $booking->pickup_time }}</a><div class="text-xs text-slate-400">Gửi {{ $booking->created_at->format('d/m/Y H:i') }}</div></td>
                        <td class="p-3">{{ $booking->pickup }} → {{ $booking->dropoff }}</td>
                        <td class="p-3">{{ $booking->passengers }}</td>
                        <td class="p-3">{{ $booking->vehicle_name }}</td>
                        <td class="p-3">{{ $booking->phone }}<div class="text-xs text-slate-500">{{ contact_channel_label($booking->contact_channel) }}</div></td>
                        <td class="p-3">{{ money($booking->estimated_price) }}</td>
                        <td class="p-3">{{ $booking->statusLabel() }}</td>
                    </tr>
                @empty
                    <tr><td class="p-6 text-slate-500" colspan="7">Chưa có đơn đặt xe.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $bookings->links() }}</div>
@endsection
