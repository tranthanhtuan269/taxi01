<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index()
    {
        return view('admin.vehicles.index', [
            'vehicles' => Vehicle::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.vehicles.form', [
            'vehicle' => new Vehicle([
                'badge_style' => 'primary',
                'icon' => 'directions_car',
                'capacity_icon' => 'group',
                'luggage_icon' => 'luggage',
                'feature_icon' => 'ac_unit',
                'is_active' => true,
            ]),
            'services' => Service::orderBy('sort_order')->get(),
            'prices' => [],
        ]);
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::create($this->validated($request));
        $this->syncPrices($request, $vehicle);
        $this->storeImage($request, $vehicle);

        return redirect()->route('admin.vehicles.index')->with('status', 'Đã thêm xe.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.form', [
            'vehicle' => $vehicle,
            'services' => Service::orderBy('sort_order')->get(),
            'prices' => $vehicle->prices->pluck('price', 'service_key'),
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->update($this->validated($request, $vehicle));
        $this->syncPrices($request, $vehicle);
        $this->storeImage($request, $vehicle);

        return redirect()->route('admin.vehicles.index')->with('status', 'Đã cập nhật xe.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image_path) {
            Storage::disk('public')->delete($vehicle->image_path);
        }
        $vehicle->delete();

        return back()->with('status', 'Đã xóa xe.');
    }

    private function validated(Request $request, ?Vehicle $vehicle = null): array
    {
        $request->merge([
            'code' => Str::lower((string) $request->input('code')),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:40', 'alpha_dash', Rule::unique('vehicles', 'code')->ignore($vehicle?->id)],
            'models' => ['nullable', 'string', 'max:255'],
            'capacity' => ['required', 'string', 'max:255'],
            'capacity_icon' => ['required', 'string', 'max:60'],
            'luggage' => ['required', 'string', 'max:255'],
            'luggage_icon' => ['required', 'string', 'max:60'],
            'highlight' => ['required', 'string', 'max:255'],
            'price_from' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:2000'],
            'badge' => ['nullable', 'string', 'max:80'],
            'badge_style' => ['required', 'in:primary,secondary,vip'],
            'icon' => ['required', 'string', 'max:60'],
            'feature_icon' => ['required', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_vip'] = $request->boolean('is_vip');
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        unset($data['image']);

        return $data;
    }

    private function syncPrices(Request $request, Vehicle $vehicle): void
    {
        foreach (Service::query()->pluck('key') as $key) {
            $vehicle->prices()->updateOrCreate(
                ['service_key' => $key],
                ['price' => max(0, (int) $request->input('prices.'.$key, 0))]
            );
        }
    }

    private function storeImage(Request $request, Vehicle $vehicle): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        if ($vehicle->image_path) {
            Storage::disk('public')->delete($vehicle->image_path);
        }

        $path = $request->file('image')->store('vehicles', 'public');
        $vehicle->update(['image_path' => $path]);
    }
}
