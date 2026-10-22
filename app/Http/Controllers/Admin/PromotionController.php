<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return view('admin.promotions.index', [
            'items' => Promotion::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.promotions.form', [
            'item' => new Promotion(['icon' => 'sell', 'is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        Promotion::create($this->validated($request));

        return redirect()->route('admin.promotions.index')->with('status', 'Đã thêm ưu đãi.');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.form', ['item' => $promotion]);
    }

    public function update(Request $request, Promotion $promotion)
    {
        $promotion->update($this->validated($request));

        return redirect()->route('admin.promotions.index')->with('status', 'Đã cập nhật ưu đãi.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return back()->with('status', 'Đã xóa ưu đãi.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:80'],
            'summary' => ['required', 'string'],
            'detail' => ['nullable', 'string'],
            'icon' => ['required', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
