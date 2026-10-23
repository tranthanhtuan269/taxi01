<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'eyebrow',
        'excerpt',
        'body',
        'image_url',
        'image_path',
        'icon',
        'pickup_default',
        'dropoff_default',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
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

        $url = (string) $this->image_url;
        if ($url === '') {
            return '';
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, '/')) {
            return $url;
        }

        return asset($url);
    }
}
