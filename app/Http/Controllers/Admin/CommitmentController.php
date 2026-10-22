<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commitment;
use Illuminate\Http\Request;

class CommitmentController extends Controller
{
    public function index()
    {
        return view('admin.commitments.index', [
            'items' => Commitment::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.commitments.form', [
            'item' => new Commitment(['icon' => 'verified', 'is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        Commitment::create($this->validated($request));

        return redirect()->route('admin.commitments.index')->with('status', 'Đã thêm cam kết.');
    }

    public function edit(Commitment $commitment)
    {
        return view('admin.commitments.form', ['item' => $commitment]);
    }

    public function update(Request $request, Commitment $commitment)
    {
        $commitment->update($this->validated($request));

        return redirect()->route('admin.commitments.index')->with('status', 'Đã cập nhật cam kết.');
    }

    public function destroy(Commitment $commitment)
    {
        $commitment->delete();

        return back()->with('status', 'Đã xóa cam kết.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
