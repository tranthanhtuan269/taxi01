@extends('layouts.admin')
@section('heading', 'Tổng quan')
@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <a class="bg-white rounded-xl p-4 shadow-sm" href="{{ route('admin.bookings.index', ['status' => 'new']) }}">
            <p class="text-sm text-slate-500">Đơn mới</p>
            <p class="text-3xl font-extrabold text-[#0f2942]">{{ $newBookings }}</p>
        </a>
        <a class="bg-white rounded-xl p-4 shadow-sm" href="{{ route('admin.callbacks.index') }}">
            <p class="text-sm text-slate-500">Cuộc gọi chờ</p>
            <p class="text-3xl font-extrabold text-[#006398]">{{ $newCallbacks }}</p>
        </a>
        <a class="bg-white rounded-xl p-4 shadow-sm" href="{{ route('admin.vehicles.index') }}">
            <p class="text-sm text-slate-500">Hạng xe</p>
            <p class="text-3xl font-extrabold text-[#0f2942]">{{ $vehicleCount }}</p>
        </a>
        <a class="bg-white rounded-xl p-4 shadow-sm" href="{{ route('admin.routes.index') }}">
            <p class="text-sm text-slate-500">Tuyến giá</p>
            <p class="text-3xl font-extrabold text-[#0f2942]">{{ $routeCount }}</p>
        </a>
    </div>
    <div class="grid lg:grid-cols-2 gap-4">
        <section class="bg-white rounded-xl shadow-sm overflow-hidden">
            <h2 class="px-4 py-3 font-bold border-b">Đơn đặt xe gần đây</h2>
            <div class="divide-y">
                @forelse($bookings as $booking)
                    <a class="block px-4 py-3 hover:bg-slate-50" href="{{ route('admin.bookings.show', $booking) }}">
                        <p class="font-semibold">{{ $booking->pickup }} → {{ $booking->dropoff }}</p>
                        <p class="text-sm text-slate-500">{{ optional($booking->pickup_date)->format('d/m/Y') }} · {{ $booking->passengers }} khách · {{ $booking->phone }} · {{ contact_channel_label($booking->contact_channel) }} · {{ money($booking->estimated_price) }}</p>
                    </a>
                @empty
                    <p class="px-4 py-6 text-sm text-slate-500">Chưa có đơn.</p>
                @endforelse
            </div>
        </section>
        <section class="bg-white rounded-xl shadow-sm overflow-hidden">
            <h2 class="px-4 py-3 font-bold border-b">Yêu cầu gọi lại</h2>
            <div class="divide-y">
                @forelse($callbacks as $item)
                    <div class="px-4 py-3">
                        <p class="font-semibold">{{ $item->phone }}</p>
                        <p class="text-sm text-slate-500">{{ contact_channel_label($item->contact_channel) ?: 'Chưa chọn kênh' }} · {{ $item->note ?: 'Không có ghi chú' }} · {{ $item->statusLabel() }}</p>
                    </div>
                @empty
                    <p class="px-4 py-6 text-sm text-slate-500">Chưa có yêu cầu.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
