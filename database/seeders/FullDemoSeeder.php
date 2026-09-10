<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Voucher;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FullDemoSeeder extends Seeder
{
    public function run(): void
    {
        $passHash = Hash::make('password123');

        // 1. Users
        $spadmin = User::updateOrCreate(
            ['email' => 'spadmin@example.com'],
            [
                'name' => 'Super Admin Demo',
                'role' => 'spadmin',
                'password' => $passHash,
                'status' => 'active',
                'phone' => '0901111111'
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Nhà Cung Cấp Demo',
                'role' => 'admin',
                'password' => $passHash,
                'status' => 'active',
                'phone' => '0902222222'
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Khách Hàng Demo',
                'role' => 'user',
                'password' => $passHash,
                'status' => 'active',
                'phone' => '0903333333'
            ]
        );

        $userLegacy = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Khách Hàng Cuong',
                'role' => 'user',
                'password' => $passHash,
                'status' => 'active',
                'phone' => '0904444444'
            ]
        );

        // 2. Destinations
        $destinationsData = [
            ['name' => 'Đà Nẵng - Hội An', 'slug' => 'da-nang-hoi-an', 'description' => 'Thành phố đáng sống và phố cổ rực rỡ đèn lồng.', 'image' => 'danang.jpg'],
            ['name' => 'Phú Quốc', 'slug' => 'phu-quoc', 'description' => 'Thiên đường đảo ngọc biển xanh cát trắng.', 'image' => 'phuquoc.jpg'],
            ['name' => 'Hạ Long', 'slug' => 'ha-long', 'description' => 'Kỳ quan thiên nhiên thế giới với hàng ngàn đảo đá.', 'image' => 'halong.jpg'],
            ['name' => 'Sapa', 'slug' => 'sapa', 'description' => 'Thành phố trong sương với ruộng bậc thang hùng vĩ.', 'image' => 'sapa.jpg'],
            ['name' => 'Đà Lạt', 'slug' => 'da-lat', 'description' => 'Thành phố ngàn hoa thơ mộng khí hậu ôn hòa.', 'image' => 'dalat.jpg']
        ];

        $dObjs = [];
        foreach ($destinationsData as $d) {
            $dObjs[] = Destination::firstOrCreate(['slug' => $d['slug']], $d);
        }

        // 3. Tours
        $toursData = [
            [
                'name' => 'Tour Đà Nẵng - Bà Nà Hills - Hội An 3N2Đ',
                'description' => 'Khám phá Cầu Vàng nổi tiếng, phố cổ Hội An và thưởng thức ẩm thực miền Trung.',
                'price' => 3500000,
                'duration' => 3,
                'max_people' => 20,
                'image' => '1.jpg',
                'destination_id' => $dObjs[0]->id,
                'provider_id' => $admin->id
            ],
            [
                'name' => 'Tour Biển Đảo Phú Quốc - Cáp Treo Hòn Thơm 4N3Đ',
                'description' => 'Trải nghiệm lặn ngắm san hô, ngắm hoàng hôn Sanato và vui chơi VinWonders.',
                'price' => 5200000,
                'duration' => 4,
                'max_people' => 15,
                'image' => '2.jpg',
                'destination_id' => $dObjs[1]->id,
                'provider_id' => $admin->id
            ],
            [
                'name' => 'Du Thuyền 5 Sao Vịnh Hạ Long 2N1Đ',
                'description' => 'Nghỉ dưỡng sang trọng trên du thuyền, chèo thuyền Kayak thăm hang Đột Phá.',
                'price' => 4800000,
                'duration' => 2,
                'max_people' => 12,
                'image' => '3.jpg',
                'destination_id' => $dObjs[2]->id,
                'provider_id' => $admin->id
            ],
            [
                'name' => 'Sapa - Fansipan Legend - Bản Cát Cát 3N2Đ',
                'description' => 'Chinh phục nóc nhà Đông Dương Fansipan và tìm hiểu văn hóa bản địa.',
                'price' => 2900000,
                'duration' => 3,
                'max_people' => 25,
                'image' => '4.jpg',
                'destination_id' => $dObjs[3]->id,
                'provider_id' => $admin->id
            ],
            [
                'name' => 'Đà Lạt Mộng Mơ - Thung Lũng Tình Yêu 3N2Đ',
                'description' => 'Check-in các tiệm cafe view mây, săn mây đồi trà Cầu Đất và vườn dâu tây.',
                'price' => 2600000,
                'duration' => 3,
                'max_people' => 20,
                'image' => '5.jpg',
                'destination_id' => $dObjs[4]->id,
                'provider_id' => $admin->id
            ]
        ];

        $tObjs = [];
        foreach ($toursData as $t) {
            $slug = Str::slug($t['name']);
            $tObjs[] = Tour::firstOrCreate(
                ['slug' => $slug],
                array_merge($t, ['slug' => $slug])
            );
        }

        // 4. Vouchers
        $vouchersData = [
            [
                'code' => 'WELCOME2026',
                'name' => 'Mã giảm giá chào mừng 2026',
                'type' => 'fixed',
                'value' => 200000,
                'min_order_value' => 1000000,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addMonths(6),
                'usage_limit' => 100,
                'status' => 'active'
            ],
            [
                'code' => 'SUMMER500K',
                'name' => 'Ưu đãi du lịch hè 500k',
                'type' => 'fixed',
                'value' => 500000,
                'min_order_value' => 3000000,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addMonths(3),
                'usage_limit' => 50,
                'status' => 'active'
            ],
            [
                'code' => 'DISCOUNT10',
                'name' => 'Giảm 10% đơn tour',
                'type' => 'percent',
                'value' => 10,
                'max_discount_amount' => 500000,
                'min_order_value' => 2000000,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addMonths(2),
                'usage_limit' => 200,
                'status' => 'active'
            ]
        ];

        foreach ($vouchersData as $v) {
            Voucher::updateOrCreate(['code' => $v['code']], $v);
        }

        // 5. Bookings
        if (Booking::count() < 10) {
            $statuses = ['paid', 'deposit_paid', 'unpaid', 'cancelled'];
            for ($i = 0; $i < 15; $i++) {
                $t = $tObjs[rand(0, count($tObjs) - 1)];
                $u = (rand(0, 1) === 1) ? $customer : $userLegacy;
                $numAdults = rand(1, 4);
                $numChildren = rand(0, 2);
                $totalPrice = ($t->price * $numAdults) + ($t->price * 0.5 * $numChildren);
                $st = $statuses[rand(0, count($statuses) - 1)];
                $depositAmt = ($st === 'deposit_paid') ? ($totalPrice * 0.3) : (($st === 'paid') ? $totalPrice : 0);
                $remAmt = $totalPrice - $depositAmt;

                $b = Booking::create([
                    'user_id' => $u->id,
                    'tour_id' => $t->id,
                    'booking_date' => Carbon::now()->subDays(rand(1, 60)),
                    'number_of_people' => $numAdults + $numChildren,
                    'num_adults' => $numAdults,
                    'num_children' => $numChildren,
                    'total_price' => $totalPrice,
                    'total_amount' => $totalPrice,
                    'deposit_amount' => $depositAmt,
                    'remaining_amount' => $remAmt,
                    'payment_status' => $st,
                    'created_at' => Carbon::now()->subDays(rand(1, 60))
                ]);

                if ($st === 'paid' && rand(0, 1) === 1) {
                    Review::create([
                        'user_id' => $u->id,
                        'tour_id' => $t->id,
                        'booking_id' => $b->id,
                        'rating' => rand(4, 5),
                        'comment' => 'Chuyến đi tuyệt vời, dịch vụ rất chu đáo và hướng dẫn viên nhiệt tình!',
                        'status' => 'approved'
                    ]);
                }
            }
        }
    }
}
