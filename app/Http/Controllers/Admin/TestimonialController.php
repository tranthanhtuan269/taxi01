<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('admin.testimonials.index', [
            'items' => Testimonial::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.testimonials.form', [
            'item' => new Testimonial(['rating' => 5, 'tone' => 'secondary', 'is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        Testimonial::create($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('status', 'Đã thêm đánh giá.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', ['item' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('status', 'Đã cập nhật đánh giá.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('status', 'Đã xóa đánh giá.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'initials' => ['required', 'string', 'max:8'],
            'tone' => ['required', 'in:secondary,muted,cyan'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
