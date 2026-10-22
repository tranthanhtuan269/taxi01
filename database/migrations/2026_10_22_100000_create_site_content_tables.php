<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('label');
            $table->string('icon')->default('local_taxi');
            $table->string('pickup_default');
            $table->string('dropoff_default');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('models')->nullable();
            $table->string('capacity');
            $table->string('capacity_icon')->default('group');
            $table->string('luggage');
            $table->string('luggage_icon')->default('luggage');
            $table->string('highlight');
            $table->unsignedInteger('price_from')->default(0);
            $table->string('image_url')->nullable();
            $table->string('image_path')->nullable();
            $table->string('badge')->nullable();
            $table->string('badge_style')->default('primary');
            $table->string('icon')->default('directions_car');
            $table->string('feature_icon')->default('ac_unit');
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('vehicle_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('service_key');
            $table->unsignedInteger('price')->default(0);
            $table->timestamps();
            $table->unique(['vehicle_id', 'service_key']);
        });

        Schema::create('fare_routes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('eyebrow')->nullable();
            $table->string('icon')->default('route');
            $table->text('description')->nullable();
            $table->string('pickup_default')->nullable();
            $table->string('dropoff_default')->nullable();
            $table->string('category')->default('transfer');
            $table->boolean('is_featured')->default(false);
            $table->string('featured_label')->nullable();
            $table->boolean('is_inquiry')->default(false);
            $table->string('inquiry_note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('fare_route_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fare_route_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->unsignedInteger('price')->nullable();
            $table->string('price_suffix')->nullable();
            $table->boolean('is_highlight')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->string('initials', 8);
            $table->string('tone')->default('secondary');
            $table->text('content');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('commitments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('verified');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('badge')->nullable();
            $table->text('summary');
            $table->text('detail')->nullable();
            $table->string('icon')->default('sell');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->longText('body');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('service_key');
            $table->string('trip_mode')->default('oneway');
            $table->string('pickup');
            $table->string('dropoff');
            $table->date('pickup_date')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('flight_number')->nullable();
            $table->string('vehicle_code')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('phone');
            $table->unsignedInteger('estimated_price')->default(0);
            $table->string('status')->default('new');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });

        Schema::create('callbacks', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('note')->nullable();
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('callbacks');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('commitments');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('fare_route_prices');
        Schema::dropIfExists('fare_routes');
        Schema::dropIfExists('vehicle_prices');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('services');
        Schema::dropIfExists('settings');
    }
};
