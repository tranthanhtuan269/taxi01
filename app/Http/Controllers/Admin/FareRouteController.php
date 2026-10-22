<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FareRoute;
use Illuminate\Http\Request;

class FareRouteController extends Controller
{
    public function index()
    {
        return view('admin.routes.index', [
            'routes' => FareRoute::with('prices')->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.routes.form', [
            'routeItem' => new FareRoute([
                'icon' => 'route',
                'category' => 'transfer',
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $route = FareRoute::create($this->validated($request));
        $this->syncPrices($request, $route);

        return redirect()->route('admin.routes.index')->with('status', 'Đã thêm tuyến.');
    }

    public function edit(FareRoute $fareRoute)
    {
        $fareRoute->load('prices');

        return view('admin.routes.form', ['routeItem' => $fareRoute]);
    }

    public function update(Request $request, FareRoute $fareRoute)
    {
        $fareRoute->update($this->validated($request));
        $this->syncPrices($request, $fareRoute);

        return redirect()->route('admin.routes.index')->with('status', 'Đã cập nhật tuyến.');
    }

    public function destroy(FareRoute $fareRoute)
    {
        $fareRoute->delete();

        return back()->with('status', 'Đã xóa tuyến.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:60'],
            'description' => ['nullable', 'string'],
            'pickup_default' => ['nullable', 'string', 'max:255'],
            'dropoff_default' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'in:airport,transfer,tour,intercity'],
            'featured_label' => ['nullable', 'string', 'max:80'],
            'inquiry_note' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_inquiry'] = $request->boolean('is_inquiry');
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }

    private function syncPrices(Request $request, FareRoute $route): void
    {
        $route->prices()->delete();
        foreach ($request->input('prices', []) as $index => $row) {
            $label = trim((string) ($row['label'] ?? ''));
            if ($label === '') {
                continue;
            }
            $raw = trim((string) ($row['price'] ?? ''));
            $route->prices()->create([
                'label' => $label,
                'price' => $raw === '' ? null : (int) preg_replace('/\D/', '', $raw),
                'price_suffix' => $row['price_suffix'] ?? null,
                'is_highlight' => ! empty($row['is_highlight']),
                'sort_order' => $index,
            ]);
        }
    }
}
