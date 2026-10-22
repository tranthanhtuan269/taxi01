<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', [
            'services' => Service::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.services.form', [
            'service' => new Service(['icon' => 'local_taxi', 'is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        Service::create($this->validated($request));

        return redirect()->route('admin.services.index')->with('status', 'Đã thêm dịch vụ đặt xe.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validated($request, $service));

        return redirect()->route('admin.services.index')->with('status', 'Đã cập nhật dịch vụ.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return back()->with('status', 'Đã xóa dịch vụ.');
    }

    private function validated(Request $request, ?Service $service = null): array
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:40', 'alpha_dash', Rule::unique('services', 'key')->ignore($service?->id)],
            'label' => ['required', 'string', 'max:80'],
            'icon' => ['required', 'string', 'max:60'],
            'pickup_default' => ['required', 'string', 'max:255'],
            'dropoff_default' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
