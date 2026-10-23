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

function contact_channels(): array
{
    $digits = preg_replace('/\D+/', '', setting('phone_tel', '0905123456')) ?: '0905123456';
    $intl = str_starts_with($digits, '0') ? '84'.substr($digits, 1) : $digits;

    $whatsapp = setting('whatsapp_url');
    if ($whatsapp === '') {
        $whatsapp = 'https://wa.me/'.$intl;
    }

    $zalo = setting('zalo_url');
    if ($zalo === '') {
        $zalo = 'https://zalo.me/'.$digits;
    }

    return [
        ['key' => 'zalo', 'label' => 'Zalo', 'url' => $zalo],
        ['key' => 'kakao', 'label' => 'Kakao', 'url' => setting('kakao_url')],
        ['key' => 'whatsapp', 'label' => 'WhatsApp', 'url' => $whatsapp],
        ['key' => 'wechat', 'label' => 'WeChat', 'url' => setting('wechat_url')],
    ];
}

function contact_channel_label(?string $key): string
{
    foreach (contact_channels() as $channel) {
        if ($channel['key'] === $key) {
            return $channel['label'];
        }
    }

    return '';
}

function money(int|string|null $amount, string $suffix = 'đ'): string
{
    if ($amount === null || $amount === '') {
        return '';
    }

    return number_format((int) $amount, 0, ',', '.').$suffix;
}
