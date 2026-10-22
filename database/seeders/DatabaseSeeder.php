<?php

namespace Database\Seeders;

use App\Models\Commitment;
use App\Models\Faq;
use App\Models\FareRoute;
use App\Models\FareRoutePrice;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Setting::query()->delete();
        VehiclePrice::query()->delete();
        FareRoutePrice::query()->delete();
        Service::query()->delete();
        Vehicle::query()->delete();
        FareRoute::query()->delete();
        Testimonial::query()->delete();
        Faq::query()->delete();
        Commitment::query()->delete();
        Promotion::query()->delete();
        Page::query()->delete();
        Schema::enableForeignKeyConstraints();

        $this->settings();
        $this->services();
        $this->vehicles();
        $this->routes();
        $this->stories();
        $this->pages();

        User::updateOrCreate(
            ['email' => 'admin@nhatrangride.vn'],
            ['name' => 'Quản trị NhaTrangRide', 'password' => 'NhaTrang@2026']
        );
    }

    private function settings(): void
    {
        $values = [
            'brand_primary' => 'NhaTrang',
            'brand_accent' => 'Ride',
            'meta_title' => 'NhaTrangRide - Taxi & Tour Du Lịch Nha Trang',
            'meta_description' => 'Taxi Nha Trang đón nhanh 5 phút, đưa đón sân bay Cam Ranh trọn gói và tour trong ngày. Giá niêm yết, xe đời mới, phục vụ 24/7.',
            'phone_display' => '0905.123.456',
            'phone_tel' => '0905123456',
            'zalo_url' => 'https://zalo.me/0905123456',
            'email' => 'booking@nhatrangride.vn',
            'address' => 'Trụ sở: 120 Trần Phú, Lộc Thọ, TP. Nha Trang, Khánh Hòa',
            'license_title' => 'Giấy phép vận tải',
            'license_text' => 'Số: 56/GP-SGTVT Khánh Hòa - Đăng ký vận chuyển khách du lịch quốc tế & nội địa.',
            'channels' => 'Zalo, WhatsApp, KakaoTalk',
            'payments' => 'VietQR, Napas, Visa, Mastercard, MoMo',
            'footer_about' => 'Dịch vụ taxi đường dài, xe đưa đón sân bay Cam Ranh và tour du lịch trọn gói uy tín hàng đầu tại vịnh biển Nha Trang.',
            'copyright' => '© 2024 NhaTrangRide. Dịch vụ vận chuyển lữ hành Khánh Hòa. All rights reserved.',
            'rating_score' => '4.9/5',
            'rating_text' => '(15.000+ chuyến xe hài lòng)',
            'badge_delay' => 'Miễn phí hủy & chờ không giới hạn khi delay',
            'badge_fixed' => 'Báo giá trọn gói 100% không phát sinh',
            'hero_kicker' => 'XE ĐÓN TẬN NƠI TẠI NHA TRANG TRONG 5 PHÚT',
            'hero_title' => 'Taxi Nha Trang Đón Nhanh 5 Phút – Trọn Gói Giá Rẻ',
            'hero_body' => 'Chuyên tuyến <strong class="text-primary font-semibold">Sân bay Cam Ranh ⇄ Nha Trang chỉ từ 180.000đ</strong>. Dàn xe đời mới 2022-2024, tài xế bản địa tận tâm, phục vụ xuyên đêm 24/7.',
            'stat_1_value' => '35km',
            'stat_1_label' => 'Sân bay ⇄ Phố biển',
            'stat_2_value' => '3 Phút',
            'stat_2_label' => 'Có xe nhận đón',
            'stat_3_value' => '0đ',
            'stat_3_label' => 'Phí cầu đường bến bãi',
            'dispatch_label' => 'Tổng đài điều phối trực 24/7',
            'dispatch_speed' => 'dưới 3 phút',
            'roundtrip_discount' => '10',
            'price_note' => 'Không phụ phí',
            'guarantee_1' => 'Không cần thanh toán trước',
            'guarantee_2' => 'Hỗ trợ lái xe gọi trước 30p',
            'pricing_kicker' => 'MINH BẠCH & TIẾT KIỆM',
            'pricing_title' => 'Bảng Giá Cước Niêm Yết Tuyến Phổ Biến',
            'pricing_body' => 'Cam kết giá cố định 100%, đã bao gồm vé qua trạm thu phí và vé bến bãi đỗ xe tại Cảng Hàng Không Quốc Tế Cam Ranh.',
            'pricing_badge' => 'Bảo hiểm hành khách đầy đủ',
            'fleet_kicker' => 'ĐỘI XE DU LỊCH 2022 - 2024',
            'fleet_title' => 'Đội Xe Đời Mới – Sạch Sẽ, Mát Lạnh, Không Mùi Say Xe',
            'fleet_body' => '100% phương tiện được vệ sinh khử khuẩn sau mỗi chuyến đi, trang bị wifi, nước suối và khăn lạnh miễn phí.',
            'why_kicker' => 'UY TÍN HÀNG ĐẦU',
            'why_title' => '4 Cam Kết Vàng Giữ Chân Du Khách Mười Năm Qua',
            'why_body' => 'Chúng tôi hiểu rằng một chuyến nghỉ dưỡng trọn vẹn bắt đầu ngay từ khoảnh khắc bạn bước xuống sân bay và kết thúc với nụ cười hài lòng khi trở về nhà.',
            'why_card_title' => 'Cần Hỗ Trợ Khẩn Cấp?',
            'why_card_body' => 'Tài xế đến đón chỉ trong 5-10 phút tại mọi khách sạn trung tâm Nha Trang.',
            'reviews_kicker' => 'CHIA SẺ TỪ HÀNH KHÁCH',
            'reviews_title' => 'Đánh Giá Thật Từ Du Khách Thực Tế',
            'reviews_score' => '4.9 / 5.0',
            'reviews_source' => '(Google Maps Reviews)',
            'faq_kicker' => 'GIẢI ĐÁP NHANH',
            'faq_title' => 'Câu Hỏi Thường Gặp Khi Đặt Xe',
            'banner_badge' => 'ƯU ĐÃI ĐẶT TRƯỚC HÔM NAY',
            'banner_title' => 'Chuẩn Bị Đến Nha Trang? Đặt Xe Trước Để Thảnh Thơi Tận Hưởng Kỳ Nghỉ!',
            'banner_body' => 'Chỉ cần để lại số điện thoại, điều phối viên NhaTrangRide sẽ gọi lại xác nhận giữ xe chất lượng cao trong vòng 60 giây.',
            'callback_title' => 'Yêu Cầu Gọi Lại Nhanh',
            'callback_body' => 'Tài xế sẵn sàng tại sân bay & các phường trung tâm.',
            'callback_button' => 'Gửi Yêu Cầu - Gọi Lại Trong 60s',
            'callback_privacy' => 'Bảo mật thông tin khách hàng tuyệt đối 100%.',
            'callback_success' => 'Cảm ơn quý khách! Tổng đài NhaTrangRide sẽ gọi lại trong ít phút.',
            'modal_title' => 'Đặt Xe Thành Công!',
            'modal_body' => 'Cảm ơn quý khách đã tin tưởng NhaTrangRide. Điều phối viên sẽ liên hệ xác nhận chuyến xe qua số điện thoại/Zalo trong ít phút.',
            'foot_routes_title' => 'Tuyến & Tour Nổi Bật',
            'foot_promise_title' => 'Cam Kết Dịch Vụ',
            'foot_contact_title' => 'Liên Hệ & Văn Phòng',
            'foot_channels_label' => 'Kênh hỗ trợ trực tuyến:',
            'foot_payments_label' => 'Thanh toán linh hoạt:',
            'foot_1_icon' => 'schedule',
            'foot_1_title' => 'Đúng giờ 100%',
            'foot_1_body' => 'Tài xế có mặt trước 15 phút giờ hẹn.',
            'foot_2_icon' => 'flight_land',
            'foot_2_title' => 'Đón miễn phí trễ chuyến',
            'foot_2_body' => 'Theo dõi chuyến bay thực tế theo số hiệu.',
            'foot_3_icon' => 'directions_car',
            'foot_3_title' => 'Xe đời mới mát lạnh',
            'foot_3_body' => '100% xe Sedan, SUV, Carnival 2021-2024.',
            'foot_4_icon' => 'sell',
            'foot_4_title' => 'Giá niêm yết minh bạch',
            'foot_4_body' => 'Trọn gói vé cầu đường, không phí ẩn.',
            'page_airport_kicker' => 'SÂN BAY CAM RANH',
            'page_airport_title' => 'Đưa Đón Sân Bay Cam Ranh – Giá Trọn Gói',
            'page_airport_intro' => 'Đón tận sảnh Ga đến quốc nội và quốc tế. Tài xế cầm bảng tên, theo dõi giờ hạ cánh và không tính phí chờ khi chuyến bay delay.',
            'page_tours_kicker' => 'TOUR TRONG NGÀY',
            'page_tours_title' => 'Tour Nha Trang Theo Xe Riêng',
            'page_tours_intro' => 'Xe riêng cho gia đình và đoàn nhỏ: city tour, biển Dốc Lết, VinWonders hoặc đường dài Đà Lạt và Mũi Né. Tài xế chờ theo lịch của bạn.',
            'page_offers_kicker' => 'ƯU ĐÃI',
            'page_offers_title' => 'Ưu Đãi Đặt Xe Nha Trang',
            'page_offers_intro' => 'Giá niêm yết đã gồm cầu đường và bến bãi. Khứ hồi được giảm thêm, chuyến bay trễ không phát sinh phí chờ.',
            'page_booking_kicker' => 'ĐẶT XE',
            'page_booking_title' => 'Đặt Xe Ngay',
            'page_booking_intro' => 'Chọn tuyến, hạng xe và giờ đón. Không cần thanh toán trước. Điều phối viên xác nhận qua điện thoại hoặc Zalo.',
        ];

        $groups = collect(config('site.fields'))->pluck('group', 'key');
        foreach ($values as $key => $value) {
            Setting::create([
                'key' => $key,
                'value' => $value,
                'group' => $groups[$key] ?? 'general',
            ]);
        }
    }

    private function services(): void
    {
        $rows = [
            ['airport', 'Sân Bay Cam Ranh', 'flight', 'Sân bay Cam Ranh (CXR)', 'Đường Trần Phú / Trung tâm TP Nha Trang', 1],
            ['city', 'Nội Thành / Tỉnh', 'local_taxi', 'Khách sạn trung tâm Nha Trang', 'Cảng Vinpearl / Ga Nha Trang', 2],
            ['tour', 'Tour Trong Ngày', 'surfing', 'Khách sạn tại Nha Trang', 'Tour City 4 Tiếng (Tháp Bà - Hòn Chồng)', 3],
            ['hourly', 'Thuê Theo Giờ', 'schedule', 'Nha Trang', 'Thuê theo giờ tự chọn (Có tài xế)', 4],
        ];

        foreach ($rows as [$key, $label, $icon, $pickup, $dropoff, $sort]) {
            Service::create([
                'key' => $key,
                'label' => $label,
                'icon' => $icon,
                'pickup_default' => $pickup,
                'dropoff_default' => $dropoff,
                'sort_order' => $sort,
                'is_active' => true,
            ]);
        }
    }

    private function vehicles(): void
    {
        $sedan = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCXdQALdcvKWPDwW86PAO7kROOGlgMYw21VXoPA2JC_SoCUpcBayiQILYfbAbsCqg3aeQui5pwtrbkKO3SAkB7UVa-VOlusJWrHYhGiUpLGTZMH3VJypYNzNIRsFCPvq_PuNBrR_4uF__wkzkirhPGpcnHfbip1sLEd1fJ3eH8ZZV41Ll8uyXFyD22hOwoQWnT5aArh-NGc_pkf9vY6BERq5givW9jEx2n0xgK3ABER5FhvH7Gyn8Ex';
        $suv = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAC4riAEQGejPnH7YPETgtCRTwjsfkQPsgalMNGlWADXb8gsYUt9tGXXStW3Dy_8V-1HBXC2jvulowmZH8djXmbpeD5Q8AKkJBEsS_lB0cq8--cC2apfgIXi2zDoubXv2ki3tg_ywockgqBdOJebaqmmmxFsInwUewOb3vLdZCh_CxUwfeEclMn-w2aH-N-qyStfRYe9EnK4dUcEsi0vk4HWMTY6teArE4RBJA58f2-QTz6QkwPIUN7';
        $limo = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCnxIFmnh-YNrwCCc4CoOGzLsCCsGFKTu7qxJBnAJy_Uei9qmwFZvWnS-0jriVYS7WQvioosnLfl-ZHX-GfEBGwgOdUOMGoZe-pSZkbIsDnetyl_i8lSYbvzVmoFvKw_eNyHqhvc2R_2CV4R-p95z6cERkJhvzp0oNZeHdT3AgIdQzV8sYcbNMhKvv4AtZBZhLXo65RmbAHbEuYMZBGLglc8nAWVJsT-D9bWSa4i_Bu1q1LYxGZ15PA';
        $van = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBAKqIObAQP5a2sbCXclZKyctU8wDFvfh4SeUA9wC4LkLUYAcqaV_mqL5OKqLu8Ce8brE8ivAc9RiLnjQrXc9F3oVOzLjpCU3uJunJQsOwZMqlIYXYddD2GBSQqmadg7FNWeiYrRc5YUXouhclcoUH8XB2k1vDvdpS548UZFEraMpIAbm0FUBXzB6FbHHEmh0nsWQjNAk7rGfuY5dMATbC01SOg52kqTUwyZwRjejAv11BlI5dCL8OS';

        $rows = [
            [
                'code' => 'sedan', 'name' => 'Xe 4 Chỗ Gia Đình', 'models' => 'Toyota Vios, Hyundai Accent, Honda City',
                'capacity' => 'Sức chứa: 1 - 3 khách người lớn', 'capacity_icon' => 'group',
                'luggage' => 'Hành lý: 2 vali size 24" + 2 túi xách', 'luggage_icon' => 'luggage',
                'highlight' => 'Điều hòa sâu, xe sạch, êm ái', 'feature_icon' => 'ac_unit',
                'price_from' => 200000, 'image_url' => $sedan, 'badge' => 'Sedan 4 Chỗ', 'badge_style' => 'primary',
                'icon' => 'directions_car', 'is_vip' => false, 'sort_order' => 1,
                'prices' => ['airport' => 200000, 'city' => 100000, 'tour' => 350000, 'hourly' => 400000],
            ],
            [
                'code' => 'suv', 'name' => 'Xe 7 Chỗ Đa Dụng', 'models' => 'Mitsubishi Xpander, Toyota Veloz, Innova',
                'capacity' => 'Sức chứa: 4 - 6 khách thoải mái', 'capacity_icon' => 'group',
                'luggage' => 'Hành lý: 3 - 4 vali cỡ lớn', 'luggage_icon' => 'luggage',
                'highlight' => 'Khoang ngồi rộng, trần xe cao thoáng', 'feature_icon' => 'airline_seat_recline_extra',
                'price_from' => 250000, 'image_url' => $suv, 'badge' => 'SUV 7 Chỗ Hot', 'badge_style' => 'secondary',
                'icon' => 'airport_shuttle', 'is_vip' => false, 'sort_order' => 2,
                'prices' => ['airport' => 250000, 'city' => 130000, 'tour' => 450000, 'hourly' => 500000],
            ],
            [
                'code' => 'limo', 'name' => 'Dcar Limousine 9 VIP', 'models' => 'Dcar President / Hyundai Solati VIP',
                'capacity' => 'Ghế massage ngả lưng không trọng lực', 'capacity_icon' => 'airline_seat_recline_normal',
                'luggage' => 'Sạc Type-C/USB từng ghế riêng biệt', 'luggage_icon' => 'power',
                'highlight' => 'Màn hình giải trí Smart TV & Loa Sony', 'feature_icon' => 'tv',
                'price_from' => 450000, 'image_url' => $limo, 'badge' => 'Hạng VIP Thượng Hạng', 'badge_style' => 'vip',
                'icon' => 'stars', 'is_vip' => true, 'sort_order' => 3,
                'prices' => ['airport' => 450000, 'city' => 220000, 'tour' => 800000, 'hourly' => 750000],
            ],
            [
                'code' => 'van16', 'name' => 'Xe 16 Chỗ Du Lịch', 'models' => 'Ford Transit & Hyundai Solati thế hệ mới',
                'capacity' => 'Sức chứa: 10 - 15 khách + hành lý', 'capacity_icon' => 'groups',
                'luggage' => 'Cốp sau cực rộng để nhiều vali to', 'luggage_icon' => 'luggage',
                'highlight' => 'Thích hợp teambuilding, gia đình lớn', 'feature_icon' => 'mic',
                'price_from' => 500000, 'image_url' => $van, 'badge' => 'Đoàn Du Lịch 16 Chỗ', 'badge_style' => 'primary',
                'icon' => 'rv_hookup', 'is_vip' => false, 'sort_order' => 4,
                'prices' => ['airport' => 500000, 'city' => 250000, 'tour' => 900000, 'hourly' => 900000],
            ],
        ];

        foreach ($rows as $row) {
            $prices = $row['prices'];
            unset($row['prices']);
            $vehicle = Vehicle::create($row + ['is_active' => true]);
            foreach ($prices as $service => $price) {
                $vehicle->prices()->create(['service_key' => $service, 'price' => $price]);
            }
        }
    }

    private function routes(): void
    {
        $routes = [
            [
                'title' => 'Sân Bay Cam Ranh ⇄ Nha Trang',
                'eyebrow' => 'Cự ly ~35km • Khoảng 35 phút',
                'icon' => 'flight_takeoff',
                'description' => 'Đón tận sảnh Ga đến (Quốc nội & Quốc tế). Tài xế cầm bảng tên, hỗ trợ hành lý chu đáo.',
                'pickup_default' => 'Sân bay Cam Ranh (CXR)',
                'dropoff_default' => 'Trung tâm TP Nha Trang',
                'category' => 'airport',
                'is_featured' => true,
                'featured_label' => 'Tuyến Đi Nhiều Nhất',
                'sort_order' => 1,
                'prices' => [
                    ['Xe 4 chỗ Sedan (Vios/Accent):', 200000, null, false],
                    ['Xe 7 chỗ SUV (Xpander/Innova):', 250000, null, false],
                    ['Xe 16 chỗ Solati / Transit:', 500000, null, false],
                    ['VIP Dcar Limousine 9 chỗ:', 450000, null, true],
                ],
            ],
            [
                'title' => 'Nha Trang ⇄ VinWonders / Cảng Cầu Đá',
                'eyebrow' => 'Cự ly ~7km • Khoảng 15 phút',
                'icon' => 'attractions',
                'description' => 'Đưa đón tận cổng cáp treo hoặc bến tàu cao tốc đi đảo Hòn Tre. Tiết kiệm hơn taxi truyền thống 30%.',
                'pickup_default' => 'Khách sạn Nha Trang',
                'dropoff_default' => 'Cảng Vinpearl Cáp Treo',
                'category' => 'transfer',
                'sort_order' => 2,
                'prices' => [
                    ['Xe 4 chỗ Sedan:', 100000, null, false],
                    ['Xe 7 chỗ SUV:', 130000, null, false],
                    ['Xe 16 chỗ Du lịch:', 250000, null, false],
                ],
            ],
            [
                'title' => 'City Tour Khám Phá Nha Trang',
                'eyebrow' => 'Lộ trình trọn gói 4 Giờ',
                'icon' => 'photo_camera',
                'description' => 'Tháp Bà Ponagar, Hòn Chồng, Chùa Long Sơn, Nhà thờ Đá, Tháp Trầm Hương. Tài xế chờ đợi thoải mái.',
                'pickup_default' => 'Khách sạn trung tâm',
                'dropoff_default' => 'City Tour Nha Trang 4 Tiếng',
                'category' => 'tour',
                'sort_order' => 3,
                'prices' => [
                    ['Xe 4 chỗ (4 giờ linh hoạt):', 350000, null, false],
                    ['Xe 7 chỗ (4 giờ gia đình):', 450000, null, false],
                    ['Phụ trội ngoài giờ:', 60000, '/giờ', false],
                ],
            ],
            [
                'title' => 'Nha Trang ⇄ Dốc Lết / Suối Ba Hồ',
                'eyebrow' => 'Dã ngoại bãi biển hoang sơ',
                'icon' => 'beach_access',
                'description' => 'Bãi cát trắng mịn, suối rừng mát mẻ phía Bắc Khánh Hòa. Đã tính thời gian tài xế đợi đưa về.',
                'pickup_default' => 'Nha Trang',
                'dropoff_default' => 'Khu du lịch Dốc Lết',
                'category' => 'tour',
                'sort_order' => 4,
                'prices' => [
                    ['Xe 4 chỗ (Khứ hồi trong ngày):', 600000, null, false],
                    ['Xe 7 chỗ (Khứ hồi trong ngày):', 750000, null, false],
                    ['Một chiều (4 chỗ):', 350000, null, false],
                ],
            ],
            [
                'title' => 'Nha Trang ⇄ Đà Lạt / Mũi Né',
                'eyebrow' => 'Liên tỉnh đường đèo ngoạn mục',
                'icon' => 'alt_route',
                'description' => 'Xe riêng gia đình qua đèo Khánh Lê sương mù huyền ảo. Dừng chụp ảnh sống ảo và nghỉ ngơi tự do.',
                'pickup_default' => 'Nha Trang',
                'dropoff_default' => 'TP. Đà Lạt (Lâm Đồng)',
                'category' => 'intercity',
                'sort_order' => 5,
                'prices' => [
                    ['Đi Đà Lạt (4 chỗ Sedan):', 1100000, null, false],
                    ['Đi Đà Lạt (7 chỗ SUV):', 1350000, null, false],
                    ['Đi Mũi Né - Phan Thiết:', 1500000, null, false],
                ],
            ],
            [
                'title' => 'Bạn Có Lộ Trình Riêng Biệt?',
                'eyebrow' => null,
                'icon' => 'route',
                'description' => 'Đi công tác, đánh golf tại KN Cam Ranh, Vinpearl Golf, chụp ảnh cưới hay thuê xe theo ngày có lái xe... Đội ngũ điều hành báo giá tốt nhất chỉ sau 60 giây.',
                'pickup_default' => 'Nha Trang',
                'dropoff_default' => 'Lộ trình theo yêu cầu',
                'category' => 'transfer',
                'is_inquiry' => true,
                'inquiry_note' => 'Phản hồi Zalo tức thì kể cả lễ Tết',
                'sort_order' => 6,
                'prices' => [],
            ],
        ];

        foreach ($routes as $row) {
            $prices = $row['prices'];
            unset($row['prices']);
            $route = FareRoute::create($row + ['is_active' => true]);
            foreach ($prices as $index => [$label, $price, $suffix, $highlight]) {
                $route->prices()->create([
                    'label' => $label,
                    'price' => $price,
                    'price_suffix' => $suffix,
                    'is_highlight' => $highlight,
                    'sort_order' => $index,
                ]);
            }
        }
    }

    private function stories(): void
    {
        Testimonial::insert([
            [
                'name' => 'Chị Nguyễn Minh Thu',
                'subtitle' => 'Du khách từ Hà Nội • Tuyến Sân Bay ⇄ Vinpearl',
                'initials' => 'NM',
                'tone' => 'secondary',
                'content' => 'Gia đình mình bay chuyến Hà Nội - Cam Ranh bị trễ gần 1 tiếng rưỡi đến tận 23h đêm mới hạ cánh. Bác tài Tuấn vẫn đứng chờ kiên nhẫn ở sảnh đến với bảng tên rõ ràng. Xe 7 chỗ Xpander rất mới, thơm mát, lái xe cẩn thận không hề phóng nhanh.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anh Trần Hoàng Quân',
                'subtitle' => 'Công ty Logistics TP.HCM • Thuê xe Limousine',
                'initials' => 'TH',
                'tone' => 'muted',
                'content' => 'Đặt thử chiếc Limousine 9 chỗ cho đoàn đối tác từ TP.HCM ra làm việc kết hợp nghỉ mát. Ghế ngồi VIP massage rất xịn, tài xế áo đồng phục lịch sự, có sẵn nước suối ướp lạnh. Giá 450k tuyến Cam Ranh là quá rẻ so với chất lượng nhận lại.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ji-hoon & Min-seo',
                'subtitle' => 'Du khách Hàn Quốc (Seoul) • Tuyến Sân Bay & City Tour',
                'initials' => 'JS',
                'tone' => 'cyan',
                'content' => 'We booked NhaTrangRide for Cam Ranh airport transfer and a 4-hour city tour. The driver was right on time, extremely polite and helped us with luggage. The fixed upfront price gave us complete peace of mind. Highly recommended for tourists!',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $faqs = [
            ['Máy bay bị hoãn (delay) tôi có bị tính thêm phí chờ không?', '<strong>Hoàn toàn không mất phí!</strong> Khi quý khách cung cấp mã hiệu chuyến bay lúc đặt xe, tổng đài và tài xế của NhaTrangRide sẽ chủ động theo dõi lịch trình bay thực tế trên hệ thống hàng không. Xe chỉ xuất hiện đón đúng khi quý khách hạ cánh và nhận xong hành lý.'],
            ['Tôi có cần phải thanh toán hoặc đặt cọc tiền trước không?', 'Đối với hầu hết các tuyến đưa đón sân bay Cam Ranh và nội thành Nha Trang, quý khách <strong>không cần đặt cọc trước bất kỳ đồng nào</strong>. Quý khách chỉ thanh toán trực tiếp cho tài xế sau khi chuyến đi hoàn thành an toàn bằng tiền mặt hoặc chuyển khoản VietQR.'],
            ['Làm thế nào tôi có thể nhận diện được tài xế đón tại sân bay?', 'Trước giờ hạ cánh 30 phút, tổng đài sẽ gửi tin nhắn SMS / Zalo cung cấp số điện thoại tài xế, biển số xe và dòng xe. Khi ra khỏi cửa sảnh đón Ga đến sân bay Cam Ranh, tài xế sẽ cầm bảng tên in rõ tên quý khách để quý khách dễ dàng nhận diện ngay lập tức.'],
            ['Giá cước trên website đã bao gồm vé bến bãi và phí cầu đường chưa?', 'Tất cả giá niêm yết của NhaTrangRide là <strong>giá trọn gói 100%</strong>, đã bao gồm phí bến bãi sân bay (10.000đ - 25.000đ/lượt) và trạm thu phí nếu có. Quý khách không phải trả thêm bất kỳ khoản chi phí phát sinh nào ngoài hợp đồng.'],
        ];
        foreach ($faqs as $i => [$question, $answer]) {
            Faq::create([
                'question' => $question,
                'answer' => $answer,
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        $commitments = [
            ['1. Đúng Giờ Tuyệt Đối', 'Tài xế luôn có mặt trước 15 phút giờ hẹn. Hệ thống tự động đồng bộ giờ hạ cánh theo số hiệu chuyến bay, máy bay đến sớm hay muộn xe vẫn chờ sẵn.', 'alarm_on'],
            ['2. Giá Trọn Gói 100%', 'Báo giá nào thanh toán đúng giá đó. Cam kết không phụ thu vé bến bãi sân bay, không phí cầu đường, không tăng giá giờ cao điểm hay mưa bão.', 'price_check'],
            ['3. Xe Đời Mới & An Toàn', 'Tất cả các dòng xe đều sản xuất từ 2022 trở lại đây, nội thất da cao cấp thơm mát, không khói thuốc, bảo hiểm trách nhiệm dân sự hành khách tối đa.', 'verified'],
            ['4. Bác Tài Nha Trang Thân Thiện', 'Tài xế bản xứ am hiểu từng góc phố, nhiệt tình hỗ trợ xách hành lý và sẵn lòng mách bạn các quán nem nướng, hải sản tươi ngon chuẩn vị giá địa phương.', 'sentiment_very_satisfied'],
        ];
        foreach ($commitments as $i => [$title, $description, $icon]) {
            Commitment::create([
                'title' => $title,
                'description' => $description,
                'icon' => $icon,
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }

        $promotions = [
            ['Khứ hồi giảm 10%', '-10%', 'Đặt chiều đi và chiều về trong cùng một yêu cầu để được giảm 10% trên tổng cước hai lượt.', 'Áp dụng cho sedan, SUV, limousine và xe 16 chỗ. Giá sau giảm hiển thị ngay trên form đặt xe khi chọn Khứ hồi.', 'percent'],
            ['Chờ chuyến bay không tính phí', 'Delay 0đ', 'Cung cấp mã chuyến bay, tài xế theo dõi giờ hạ cánh thực tế và đón khi bạn đã nhận hành lý.', 'Không phụ thu giờ chờ tại sân bay Cam Ranh, kể cả khi máy bay đến muộn ban đêm.', 'flight_land'],
            ['Không cần đặt cọc', '0đ trước', 'Giữ xe bằng số điện thoại. Thanh toán cho tài xế khi kết thúc chuyến bằng tiền mặt hoặc VietQR.', 'Phù hợp khách đến lần đầu, chưa muốn chuyển khoản trước.', 'payments'],
            ['Đặt trước trong ngày', 'Ưu tiên xe mới', 'Gửi yêu cầu hôm nay để điều phối giữ xe đời mới, đúng hạng đã chọn.', 'Điều phối viên gọi lại trong khoảng 60 giây trong giờ làm việc và vẫn trực xuyên đêm.', 'calendar_clock'],
        ];
        foreach ($promotions as $i => [$title, $badge, $summary, $detail, $icon]) {
            Promotion::create([
                'title' => $title,
                'badge' => $badge,
                'summary' => $summary,
                'detail' => $detail,
                'icon' => $icon,
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }
    }

    private function pages(): void
    {
        Page::insert([
            [
                'slug' => 'dieu-khoan',
                'title' => 'Điều khoản sử dụng',
                'body' => "Khi đặt xe trên NhaTrangRide, quý khách xác nhận điểm đón, điểm đến, thời gian và hạng xe. Giá hiển thị là giá trọn gói cho lộ trình đã chọn, đã gồm cầu đường và bến bãi theo bảng giá đang niêm yết.\n\nQuý khách có thể đổi giờ hoặc hủy trước giờ đón mà không mất phí đối với tuyến sân bay Cam Ranh khi đã cung cấp mã chuyến bay. Với tour và đường dài, vui lòng báo tổng đài sớm để điều phối xe khác.\n\nHành khách chịu trách nhiệm về hành lý cá nhân. Tài xế hỗ trợ khuân vác tại điểm đón và điểm trả.",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'chinh-sach-bao-mat',
                'title' => 'Chính sách bảo mật',
                'body' => "NhaTrangRide chỉ dùng số điện thoại, điểm đón, điểm đến và mã chuyến bay để điều phối tài xế và xác nhận chuyến đi.\n\nThông tin không được bán cho bên thứ ba. Nhân viên tổng đài và tài xế nhận chuyến chỉ thấy dữ liệu cần thiết để đón đúng khách.\n\nQuý khách có thể yêu cầu xóa số điện thoại khỏi danh sách chăm sóc sau khi chuyến đi kết thúc bằng cách nhắn Zalo hoặc gọi tổng đài.",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'bao-hiem-hanh-khach',
                'title' => 'Bảo hiểm hành khách',
                'body' => "Mỗi chuyến xe hoạt động với bảo hiểm trách nhiệm dân sự của chủ xe đối với hành khách, theo quy định hiện hành.\n\nXe trong đội hình được đăng kiểm và bảo dưỡng định kỳ. Tài xế được phổ biến quy trình đón sân bay, hỗ trợ hành lý và không sử dụng chất kích thích khi lái xe.\n\nNếu phát sinh sự cố trên đường, tổng đài trực 24/7 để điều xe thay thế hoặc hỗ trợ y tế theo tình huống.",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
