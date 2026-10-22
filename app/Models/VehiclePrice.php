<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehiclePrice extends Model
{
    protected $fillable = ['vehicle_id', 'service_key', 'price'];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
