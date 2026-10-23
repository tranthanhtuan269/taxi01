<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedTinyInteger('passengers')->default(1);
            $table->string('contact_channel', 20)->default('zalo');
        });

        Schema::table('callbacks', function (Blueprint $table) {
            $table->string('contact_channel', 20)->nullable();
        });

        $defaults = [
            'whatsapp_url' => 'https://wa.me/84794466093',
            'kakao_url' => '',
            'wechat_url' => '',
        ];

        foreach ($defaults as $key => $value) {
            Setting::query()->firstOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'Thương hiệu & liên hệ']
            );
        }
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['passengers', 'contact_channel']);
        });

        Schema::table('callbacks', function (Blueprint $table) {
            $table->dropColumn('contact_channel');
        });

        Setting::query()->whereIn('key', ['whatsapp_url', 'kakao_url', 'wechat_url'])->delete();
    }
};
