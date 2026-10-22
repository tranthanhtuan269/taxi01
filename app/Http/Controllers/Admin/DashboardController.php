<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Callback;
use App\Models\FareRoute;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'newBookings' => Booking::where('status', 'new')->count(),
            'newCallbacks' => Callback::where('status', 'new')->count(),
            'vehicleCount' => Vehicle::count(),
            'routeCount' => FareRoute::count(),
            'bookings' => Booking::latest()->limit(6)->get(),
            'callbacks' => Callback::latest()->limit(6)->get(),
        ]);
    }
}
