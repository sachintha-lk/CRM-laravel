<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Nail Extensions',
            'slug' => 'nail-extensions',
            'description' => 'Get beautiful nail extensions for a stylish look.',
            'image' => 'nail_extensions.jpg',
            'price' => 1250.00,
            'notes' => 'Choose from a variety of nail designs and colors.',
            'allergens' => null, // No allergens in this service
            'benefits' => 'Adds length and beauty to your nails.',
            'aftercare_tips' => 'Avoid harsh chemicals on your nails to maintain the extensions.',
            'cautions' => null, // No specific cautions for this service
//            'duration_minutes' => 90, // Duration in minutes
            'category_id' => 2, // Replace with the actual category ID
            'is_hidden' => false,
        ]);

        Service::create([
            'name' => 'Hair Coloring - Highlights',
            'slug' => 'hair-coloring-highlights',
            'description' => 'Add vibrant highlights to your hair for a stunning effect.',
            'image' => 'hair_coloring_highlights.jpg',
            'price' => 3000.00,
            'notes' => 'Consult with our colorist for the best shade selection.',
            'allergens' => 'Hair dye may contain allergens; inform us of any allergies.',
            'benefits' => 'Transform your look with beautifully colored highlights.',
            'aftercare_tips' => 'Use color-safe shampoos and conditioners to preserve color.',
            'cautions' => 'Patch test required for new clients with allergies.',
//            'duration_minutes' => 120, // Duration in minutes
            'category_id' => 3, // Replace with the actual category ID
            'is_hidden' => false,
        ]);

        Service::create([
            'name' => 'Hair Treatment - Deep Conditioning',
            'slug' => 'hair-treatment-deep-conditioning',
            'description' => 'Revitalize your hair with deep conditioning treatment.',
            'image' => 'hair_treatment_deep_conditioning.jpg',
            'price' => 4000.00,
            'notes' => 'Recommended for dry and damaged hair.',
            'allergens' => null, // No allergens in this service
            'benefits' => 'Nourish and repair your hair for improved texture and shine.',
            'aftercare_tips' => 'Use recommended hair masks for ongoing maintenance.',
            'cautions' => null, // No specific cautions for this service
//            'duration_minutes' => 60, // Duration in minutes
            'category_id' => 3, // Replace with the actual category ID
            'is_hidden' => false,
        ]);


        Service::create([
            'name' => 'Hair Treatment - Scalp Massage',
            'slug' => 'hair-treatment-scalp-massage',
            'description' => 'Relaxing scalp massage to rejuvenate your hair and mind.',
            'image' => 'hair_treatment_scalp_massage.jpg',
            'price' => 3500.00,
            'notes' => 'Enjoy a soothing massage with aromatic oils.',
            'allergens' => 'Massage oils may contain allergens; inform us of any allergies.',
            'benefits' => 'Promote scalp health and reduce stress with this pampering treatment.',
            'aftercare_tips' => 'Take time to relax and destress after the treatment.',
            'cautions' => null, // No specific cautions for this service
//            'duration_minutes' => 45, // Duration in minutes
            'category_id' => 3, // Replace with the actual category ID
            'is_hidden' => false,
        ]);





    }
}
