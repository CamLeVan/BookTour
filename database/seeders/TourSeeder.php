<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = \App\Models\Destination::all();
        if ($destinations->isEmpty()) {
            return;
        }

        $tours = [
            [
                'name' => 'Bali Adventure',
                'description' => 'Experience the serene beaches and vibrant culture of Bali.',
                'price' => 18000000,
                'duration' => 7,
                'max_people' => 15,
                'image' => 'img/tours/bali1.jpg',
                'destination_id' => $destinations->first()->id,
                'slug' => Str::slug('Bali Adventure') . '-' . uniqid(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Swiss Alps Escape',
                'description' => 'Discover the breathtaking views and cozy chalets of the Swiss Alps.',
                'price' => 32000000,
                'duration' => 12,
                'max_people' => 10,
                'image' => 'img/tours/swiss_alps.jpg',
                'destination_id' => $destinations->skip(1)->first()->id ?? $destinations->first()->id,
                'slug' => Str::slug('Swiss Alps Escape') . '-' . uniqid(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amazon Rainforest Expedition',
                'description' => 'Explore the rich biodiversity and untamed beauty of the Amazon Rainforest.',
                'price' => 22000000,
                'duration' => 8,
                'max_people' => 8,
                'image' => 'img/tours/amazon.jpg',
                'destination_id' => $destinations->skip(2)->first()->id ?? $destinations->first()->id,
                'slug' => Str::slug('Amazon Rainforest Expedition') . '-' . uniqid(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}
