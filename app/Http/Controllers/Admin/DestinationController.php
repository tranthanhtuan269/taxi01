<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DestinationController extends Controller
{
    public function index()
    {
        return view('admin.destinations.index', [
            'items' => Destination::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.destinations.form', [
            'item' => new Destination([
                'icon' => 'explore',
                'is_active' => true,
                'pickup_default' => 'Trung tâm Nha Trang',
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $destination = Destination::create($this->validated($request));
        $this->storeImage($request, $destination);

        return redirect()->route('admin.destinations.index')->with('status', 'Đã thêm bài viết điểm du lịch.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.form', ['item' => $destination]);
    }

    public function update(Request $request, Destination $destination)
    {
        $destination->update($this->validated($request, $destination));
        $this->storeImage($request, $destination);

        return redirect()->route('admin.destinations.index')->with('status', 'Đã cập nhật bài viết.');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image_path) {
            Storage::disk('public')->delete($destination->image_path);
        }
        $destination->delete();

        return back()->with('status', 'Đã xóa bài viết.');
    }

    private function validated(Request $request, ?Destination $destination = null): array
    {
        $slug = Str::slug((string) $request->input('slug', ''));
        if ($slug === '') {
            $slug = Str::slug((string) $request->input('title'));
        }
        $request->merge(['slug' => $slug]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('destinations', 'slug')->ignore($destination?->id)],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:60'],
            'pickup_default' => ['nullable', 'string', 'max:255'],
            'dropoff_default' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
        unset($data['image']);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }

    private function storeImage(Request $request, Destination $destination): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        if ($destination->image_path) {
            Storage::disk('public')->delete($destination->image_path);
        }

        $path = $request->file('image')->store('destinations', 'public');
        $destination->update(['image_path' => $path]);
    }
}
