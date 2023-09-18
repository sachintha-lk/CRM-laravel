<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        // create mock services
        \App\Models\Service::create([
            'name' => 'Haircut',
            'description' => 'Haircut',
            'image' => 'haircut.jpg',
            'price' => 20,
            'is_hidden' => '0',
            'category_id' => 3,
        ]);

        \App\Models\Service::create([
            'name' => 'Haircut & Beard',
            'description' => 'Haircut & Beard',
            'image' => 'haircut_beard.jpg',
            'price' => 25,
            'is_hidden' => '0',
            'category_id' => 3,
        ]);

        \App\Models\Service::create([
            'name' => 'Haircut & Shave',
            'description' => 'Haircut & Shave',
            'image' => 'haircut_shave.jpg',
            'price' => 30,
            'is_hidden' => '0',
            'category_id' => 3,
        ]);

        \App\Models\Service::create([
            'name' => 'Haircut, Beard & Shave',
            'description' => 'Haircut, Beard & Shave',
            'image' => 'haircut_beard_shave.jpg',
            'price' => 35,
            'is_hidden' => '0',
            'category_id' => 3,
        ]);

        \App\Models\Service::create([
            'name' => 'Haircut & Color',
            'description' => 'Haircut & Color',
            'image' => 'haircut_color.jpg',
            'price' => 40,
            'is_hidden' => '0',
            'category_id' => 3,
        ]);

        \App\Models\Service::create([
            'name' => 'Haircut, Beard & Color',
            'description' => 'Haircut, Beard & Color',
            'image' => 'haircut_beard_color.jpg',
            'price' => 45,
            'is_hidden' => '0',
            'category_id' => 3,
        ]);

        \App\Models\Service::create([
            'name' => 'Manicure',
            'description' => 'Manicure',
            'image' => 'manicure.jpg',
            'price' => 20,
            'is_hidden' => '0',
            'category_id' => 4,
        ]);

        \App\Models\Service::create(
            [
                'name' => 'Pedicure',
                'description' => 'Pedicure',
                'image' => 'pedicure.jpg',
                'price' => 25,
                'is_hidden' => '0',
                'category_id' => 4,
            ]
        );


        \App\Models\Service::create(
            [
                'name' => 'Facial',
                'description' => 'Facial',
                'image' => 'facial.jpg',
                'price' => 30,
                'is_hidden' => '0',
                'category_id' => 1,
            ]
        );

        \App\Models\Service::create(
            [
                'name' => 'Makeup',
                'description' => 'Makeup',
                'image' => 'makeup.jpg',
                'price' => 35,
                'is_hidden' => '0',
                'category_id' => 2,
            ]
        );

        \App\Models\Service::create(
            [
                'name' => 'Hair Styling',
                'description' => 'Hair Styling',
                'image' => 'hair_styling.jpg',
                'price' => 40,
                'is_hidden' => '0',
                'category_id' => 3,
            ]
        );


    }
}
