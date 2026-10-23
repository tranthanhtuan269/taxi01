<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_key' => ['required', 'string', 'exists:services,key'],
            'trip_mode' => ['required', 'in:oneway,roundtrip'],
            'pickup' => ['required', 'string', 'max:255'],
            'dropoff' => ['required', 'string', 'max:255'],
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'pickup_time' => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'flight_number' => ['nullable', 'string', 'max:40'],
            'vehicle_code' => ['required', 'string', 'exists:vehicles,code'],
            'passengers' => ['required', 'integer', 'min:1', 'max:45'],
            'contact_channel' => ['required', 'in:zalo,kakao,whatsapp,wechat'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^(0|\+84)[0-9\s\.]{8,16}$/'],
        ], [
            'pickup.required' => 'Vui lòng nhập điểm đón.',
            'dropoff.required' => 'Vui lòng nhập điểm đến.',
            'pickup_date.required' => 'Vui lòng chọn ngày đặt.',
            'pickup_time.required' => 'Vui lòng chọn giờ đón.',
            'passengers.required' => 'Vui lòng nhập số lượng hành khách.',
            'passengers.min' => 'Số lượng hành khách ít nhất là 1.',
            'passengers.max' => 'Số lượng hành khách tối đa là 45.',
            'contact_channel.required' => 'Vui lòng chọn kênh liên hệ.',
            'vehicle_code.required' => 'Vui lòng chọn hạng xe.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại chưa đúng định dạng.',
        ]);

        $vehicle = Vehicle::with('prices')->where('code', $data['vehicle_code'])->where('is_active', true)->firstOrFail();
        $service = Service::where('key', $data['service_key'])->where('is_active', true)->firstOrFail();

        $unit = $vehicle->priceFor($service->key);
        $discount = max(0, min(90, (int) setting('roundtrip_discount', '10')));
        $price = $data['trip_mode'] === 'roundtrip'
            ? (int) round($unit * 2 * (100 - $discount) / 100)
            : $unit;

        Booking::create([
            'service_key' => $service->key,
            'trip_mode' => $data['trip_mode'],
            'pickup' => $data['pickup'],
            'dropoff' => $data['dropoff'],
            'pickup_date' => $data['pickup_date'],
            'pickup_time' => substr($data['pickup_time'], 0, 5),
            'flight_number' => $data['flight_number'] ?? null,
            'vehicle_code' => $vehicle->code,
            'vehicle_name' => $vehicle->name,
            'phone' => $data['phone'],
            'passengers' => $data['passengers'],
            'contact_channel' => $data['contact_channel'],
            'estimated_price' => $price,
            'status' => 'new',
        ]);

        return back()->with('booking_success', [
            'route' => $data['pickup'].' ➔ '.$data['dropoff'],
            'vehicle' => $vehicle->name,
            'price' => money($price),
        ]);
    }
}
