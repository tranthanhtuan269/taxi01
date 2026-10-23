<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public const STATUSES = [
        'new' => 'Mới',
        'confirmed' => 'Đã xác nhận',
        'completed' => 'Hoàn thành',
        'cancelled' => 'Đã hủy',
    ];

    protected $fillable = [
        'service_key', 'trip_mode', 'pickup', 'dropoff', 'pickup_date', 'pickup_time',
        'flight_number', 'vehicle_code', 'vehicle_name', 'phone', 'passengers', 'contact_channel', 'estimated_price',
        'status', 'admin_note',
    ];

    protected function casts(): array
    {
        return [
            'pickup_date' => 'date',
            'estimated_price' => 'integer',
            'passengers' => 'integer',
        ];
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
