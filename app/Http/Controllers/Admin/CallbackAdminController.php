<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Illuminate\Http\Request;

class CallbackAdminController extends Controller
{
    public function index()
    {
        return view('admin.callbacks.index', [
            'items' => Callback::latest()->paginate(20),
        ]);
    }

    public function update(Request $request, Callback $callback)
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,called,closed'],
        ]);
        $callback->update($data);

        return back()->with('status', 'Đã cập nhật yêu cầu gọi lại.');
    }

    public function destroy(Callback $callback)
    {
        $callback->delete();

        return back()->with('status', 'Đã xóa yêu cầu gọi lại.');
    }
}
