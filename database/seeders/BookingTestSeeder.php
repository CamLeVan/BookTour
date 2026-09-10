<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Tour;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BookingTestSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách users và tours
        $users = User::where('role', 'user')->get();
        $tours = Tour::all();

        // Nếu không có users hoặc tours, tạo mới
        if ($users->isEmpty()) {
            for ($i = 0; $i < 10; $i++) {
                $users[] = User::create([
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'),
                    'phone' => $faker->phoneNumber,
                    'role' => 'user'
                ]);
            }
        }

        // Nếu không có tours, tạo mới
        if ($tours->isEmpty()) {
            for ($i = 0; $i < 5; $i++) {
                $tours[] = Tour::create([
                    'name' => $faker->city . ' Tour',
                    'price' => $faker->numberBetween(1000000, 5000000),
                    'description' => $faker->paragraph,
                    'duration' => $faker->numberBetween(1, 7) . ' ngày'
                ]);
            }
        }

        // Tạo bookings cho 6 tháng gần đây
        for ($i = 0; $i < 180; $i++) {
            $date = Carbon::now()->subDays(rand(0, 180));
            $tour = $tours->random();
            $user = $users->random();
            $numberOfPeople = rand(1, 5);

            Booking::create([
                'user_id' => $user->id,
                'tour_id' => $tour->id,
                'booking_date' => $date,
                'number_of_people' => $numberOfPeople,
                'total_price' => $tour->price * $numberOfPeople,
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }

        // Tạo thêm bookings cho tuần này
        for ($i = 0; $i < 20; $i++) {
            $date = Carbon::now()->subDays(rand(0, 7));
            $tour = $tours->random();
            $user = $users->random();
            $numberOfPeople = rand(1, 5);

            Booking::create([
                'user_id' => $user->id,
                'tour_id' => $tour->id,
                'booking_date' => $date,
                'number_of_people' => $numberOfPeople,
                'total_price' => $tour->price * $numberOfPeople,
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }

        // Tạo bookings cho hôm nay
        for ($i = 0; $i < 5; $i++) {
            $date = Carbon::now();
            $tour = $tours->random();
            $user = $users->random();
            $numberOfPeople = rand(1, 5);

            Booking::create([
                'user_id' => $user->id,
                'tour_id' => $tour->id,
                'booking_date' => $date,
                'number_of_people' => $numberOfPeople,
                'total_price' => $tour->price * $numberOfPeople,
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
