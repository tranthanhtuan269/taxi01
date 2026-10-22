<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FareRoute extends Model
{
    protected $fillable = [
        'title', 'eyebrow', 'icon', 'description', 'pickup_default', 'dropoff_default',
        'category', 'is_featured', 'featured_label', 'is_inquiry', 'inquiry_note',
        'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_inquiry' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function prices(): HasMany
    {
        return $this->hasMany(FareRoutePrice::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public static function categories(): array
    {
        return [
            'airport' => 'Sân bay',
            'transfer' => 'Nội thành',
            'tour' => 'Tour trong ngày',
            'intercity' => 'Liên tỉnh',
        ];
    }
}
