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
                'name' => 'Maldives Tour',
                'description' => 'Explore the beautiful islands of Maldives',
                'price' => 2500,
                'duration' => 10,
                'max_people' => 12,
                'location' => 'Maldives',
                'image' => 'img/tours/maldives1.jpg',
                'destination_id' => 1
            ],
            [
                'name' => 'Italy Adventure',
                'description' => 'Discover historic Italy',
                'price' => 1300,
                'duration' => 6,
                'max_people' => 10,
                'location' => 'Italy',
                'image' => 'img/tours/italy1.jpg',
                'destination_id' => 2
            ],
            [
                'name' => 'France Explorer',
                'description' => 'Experience romantic France',
                'price' => 400,
                'duration' => 10,
                'max_people' => 6,
                'location' => 'France',
                'image' => 'img/tours/france1.jpg',
                'destination_id' => 3
            ],
            [
                'name' => 'Greece Discovery',
                'description' => 'Visit ancient Greek ruins',
                'price' => 500,
                'duration' => 10,
                'max_people' => 12,
                'location' => 'Greece',
                'image' => 'img/tours/greece1.jpg',
                'destination_id' => 4
            ],
            [
                'name' => 'Canada Nature Tour',
                'description' => 'Experience Canadian wilderness',
                'price' => 300,
                'duration' => 7,
                'max_people' => 10,
                'location' => 'Canada',
                'image' => 'img/tours/canada1.jpg',
                'destination_id' => 5
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}