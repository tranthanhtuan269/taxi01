<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%'.$request->string('q').'%';
                $query->where(function ($inner) use ($term) {
                    $inner->where('phone', 'like', $term)
                        ->orWhere('pickup', 'like', $term)
                        ->orWhere('dropoff', 'like', $term)
                        ->orWhere('vehicle_name', 'like', $term);
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.bookings.index', [
            'bookings' => $bookings,
        ]);
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', ['booking' => $booking]);
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,confirmed,completed,cancelled'],
            'admin_note' => ['nullable', 'string'],
        ]);
        $booking->update($data);

        return back()->with('status', 'Đã cập nhật đơn đặt xe.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('status', 'Đã xóa đơn đặt xe.');
    }
}
