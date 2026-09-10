<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    public function run()
    {
        $tours = [
            [
                'name' => 'Tour Phú Quốc 3N2Đ',
                'description' => 'Khám phá đảo ngọc Phú Quốc',
                'price' => 599.99,
                'duration' => 3,
                'max_people' => 12,
                'location' => 'Phú Quốc',
                'image' => 'frontend/img/tours/maldives1.jpg',
                'destination_id' => 1
            ],
            [
                'name' => 'Tour Đà Lạt 4N3Đ',
                'description' => 'Thành phố ngàn hoa Đà Lạt',
                'price' => 699.99,
                'duration' => 4,
                'max_people' => 15,
                'location' => 'Đà Lạt',
                'image' => 'frontend/img/tours/maldives1.jpg',
                'destination_id' => 2
            ],
            // Thêm các tours khác
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}