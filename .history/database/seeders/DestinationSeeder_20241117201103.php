<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            [
                'name' => 'Phú Quốc',
                'slug' => 'phu-quoc',
                'description' => 'Đảo ngọc Phú Quốc xinh đẹp',
                'image' => 'frontend/img/destinations/1.jpg'
            ],
            [
                'name' => 'Đà Lạt',
                'slug' => 'da-lat',
                'description' => 'Thành phố ngàn hoa',
                'image' => 'frontend/img/destinations/2.jpg'
            ],
            // Thêm các destinations khác
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}
