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
                'name' => 'Maldives',
                'slug' => 'maldives',
                'description' => 'Beautiful islands in the Indian Ocean',
                'image' => 'img/tours/maldives1.jpg'
            ],
            [
                'name' => 'Italy',
                'slug' => 'italy', 
                'description' => 'Historic European destination',
                'image' => 'img/tours/italy1.jpg'
            ],
            [
                'name' => 'France',
                'slug' => 'france',
                'description' => 'Romantic European country',
                'image' => 'img/tours/france1.jpg'
            ],
            [
                'name' => 'Greece',
                'slug' => 'greece',
                'description' => 'Ancient Mediterranean civilization',
                'image' => 'img/tours/greece1.jpg'
            ],
            [
                'name' => 'Canada',
                'slug' => 'canada',
                'description' => 'Natural beauty of North America',
                'image' => 'img/tours/canada1.jpg'
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::firstOrCreate(['slug' => $destination['slug']], $destination);
        }
    }
}
