<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', [
            'items' => Page::orderBy('title')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.form', [
            'item' => new Page(['is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        Page::create($this->validated($request));

        return redirect()->route('admin.pages.index')->with('status', 'Đã thêm trang.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', ['item' => $page]);
    }

    public function update(Request $request, Page $page)
    {
        $page->update($this->validated($request, $page));

        return redirect()->route('admin.pages.index')->with('status', 'Đã cập nhật trang.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return back()->with('status', 'Đã xóa trang.');
    }

    private function validated(Request $request, ?Page $page = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:80', Rule::unique('pages', 'slug')->ignore($page?->id)],
            'body' => ['required', 'string'],
        ]);
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
