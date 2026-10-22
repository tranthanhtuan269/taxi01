<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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
}
