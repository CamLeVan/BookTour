<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    public function run()
    {
        $tours = [
            [
                'name' => 'Tour Phú Quốc 3N2Đ',
                'duration' => 3,
                'price' => 599,
                'max_people' => 12,
                'location' => 'Phú Quốc',
                'image' => 'frontend/img/tours/1.jpg'
            ],
            [
                'name' => 'Tour Đà Lạt 4N3Đ',
                'duration' => 4,
                'price' => 699,
                'max_people' => 15,
                'location' => 'Đà Lạt',
                'image' => 'frontend/img/tours/2.jpg'
            ],
            // Thêm các tour khác...
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}