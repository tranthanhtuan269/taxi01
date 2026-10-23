<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\CallbackAdminController;
use App\Http\Controllers\Admin\CommitmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FareRouteController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bang-gia', [PageController::class, 'pricing'])->name('pricing');
Route::get('/san-bay-cam-ranh', [PageController::class, 'airport'])->name('airport');
Route::get('/tour-trong-ngay', [PageController::class, 'tours'])->name('tours');
Route::get('/doi-xe', [PageController::class, 'fleet'])->name('fleet');
Route::get('/diem-du-lich/{destination:slug}', [PageController::class, 'destination'])->name('destinations.show');
Route::get('/uu-dai', [PageController::class, 'offers'])->name('offers');
Route::get('/dat-xe', [PageController::class, 'booking'])->name('booking');
Route::post('/dat-xe', [BookingController::class, 'store'])->middleware('throttle:30,1')->name('booking.store');
Route::post('/yeu-cau-goi-lai', [CallbackController::class, 'store'])->middleware('throttle:20,1')->name('callback.store');
Route::get('/trang/{slug}', [PageController::class, 'show'])->name('page.show');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'show'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/cai-dat', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/cai-dat', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('vehicles', VehicleController::class)->except(['show']);
    Route::resource('routes', FareRouteController::class)->except(['show'])->parameters(['routes' => 'fareRoute']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('commitments', CommitmentController::class)->except(['show']);
    Route::resource('promotions', PromotionController::class)->except(['show']);
    Route::resource('pages', AdminPageController::class)->except(['show']);
    Route::resource('destinations', DestinationController::class)->except(['show']);
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingAdminController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}', [BookingAdminController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingAdminController::class, 'destroy'])->name('bookings.destroy');
    Route::get('/callbacks', [CallbackAdminController::class, 'index'])->name('callbacks.index');
    Route::put('/callbacks/{callback}', [CallbackAdminController::class, 'update'])->name('callbacks.update');
    Route::delete('/callbacks/{callback}', [CallbackAdminController::class, 'destroy'])->name('callbacks.destroy');
});
