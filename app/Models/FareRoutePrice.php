<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FareRoutePrice extends Model
{
    protected $fillable = [
        'fare_route_id', 'label', 'price', 'price_suffix', 'is_highlight', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_highlight' => 'boolean',
        ];
    }

    public function fareRoute(): BelongsTo
    {
        return $this->belongsTo(FareRoute::class);
    }

    public function formatted(): string
    {
        if ($this->price === null) {
            return (string) $this->price_suffix;
        }

        return money($this->price).($this->price_suffix ? $this->price_suffix : '');
    }
}
