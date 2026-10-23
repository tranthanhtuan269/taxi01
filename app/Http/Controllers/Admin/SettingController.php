<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $stored = Setting::query()->pluck('value', 'key');

        return view('admin.settings', [
            'fields' => config('site.fields'),
            'stored' => $stored,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:2048'],
        ], [
            'logo.mimes' => 'Logo chỉ nhận PNG, JPG, WEBP, GIF hoặc SVG.',
            'logo.max' => 'Logo tối đa 2MB.',
        ]);

        $this->storeLogo($request);

        $allowed = collect(config('site.fields'))->pluck('key')->all();
        $groups = collect(config('site.fields'))->pluck('group', 'key');
        $incoming = $request->input('settings', []);

        foreach ($allowed as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => (string) ($incoming[$key] ?? ''),
                    'group' => $groups[$key] ?? 'general',
                ]
            );
        }

        return back()->with('status', 'Đã lưu nội dung trang.');
    }

    private function storeLogo(Request $request): void
    {
        if (! $request->hasFile('logo') && ! $request->boolean('remove_logo')) {
            return;
        }

        $current = (string) Setting::query()->where('key', 'logo_path')->value('value');

        if ($current !== '') {
            Storage::disk('public')->delete($current);
        }

        $path = '';
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
        }

        Setting::updateOrCreate(
            ['key' => 'logo_path'],
            ['value' => $path, 'group' => 'Thương hiệu & liên hệ']
        );
    }
}
