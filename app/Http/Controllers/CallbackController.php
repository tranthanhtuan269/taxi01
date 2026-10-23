<?php

namespace App\Http\Controllers;

use App\Models\Callback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallbackController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'callback_phone' => ['required', 'string', 'max:30', 'regex:/^(0|\+84)[0-9\s\.]{8,16}$/'],
            'note' => ['nullable', 'string', 'max:255'],
            'contact_channel' => ['required', 'in:zalo,kakao,whatsapp,wechat'],
        ], [
            'callback_phone.required' => 'Vui lòng nhập số điện thoại để được gọi lại.',
            'callback_phone.regex' => 'Số điện thoại chưa đúng định dạng.',
            'contact_channel.required' => 'Vui lòng chọn kênh liên hệ.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'callback')->withInput();
        }

        $valid = $validator->validated();
        Callback::create([
            'phone' => $valid['callback_phone'],
            'note' => $valid['note'] ?? null,
            'contact_channel' => $valid['contact_channel'],
        ]);

        return back()->with('callback_success', setting(
            'callback_success',
            'Cảm ơn quý khách! Tổng đài sẽ gọi lại trong ít phút.'
        ));
    }
}
