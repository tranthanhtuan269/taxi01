<?php

use App\Models\Setting;

function setting(string $key, string $default = ''): string
{
    static $settings;

    if ($settings === null) {
        try {
            $settings = Setting::query()->pluck('value', 'key')->all();
        } catch (Throwable $e) {
            $settings = [];
        }
    }

    $value = $settings[$key] ?? $default;

    return $value === null ? $default : (string) $value;
}

function logo_url(): string
{
    $path = setting('logo_path');

    return $path !== '' ? asset('storage/'.$path) : '';
}

function money(int|string|null $amount, string $suffix = 'đ'): string
{
    if ($amount === null || $amount === '') {
        return '';
    }

    return number_format((int) $amount, 0, ',', '.').$suffix;
}
