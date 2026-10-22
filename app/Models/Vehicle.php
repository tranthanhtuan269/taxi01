<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'code', 'name', 'models', 'capacity', 'capacity_icon', 'luggage', 'luggage_icon', 'highlight', 'price_from',
        'image_url', 'image_path', 'badge', 'badge_style', 'icon', 'feature_icon',
        'is_vip', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price_from' => 'integer',
            'is_vip' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function prices(): HasMany
    {
        return $this->hasMany(VehiclePrice::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function displayImage(): string
    {
        if ($this->image_path) {
            return asset('storage/'.$this->image_path);
        }

        return (string) $this->image_url;
    }

    public function priceFor(string $serviceKey): int
    {
        $price = $this->prices->firstWhere('service_key', $serviceKey);

        return (int) ($price->price ?? $this->price_from);
    }
}
