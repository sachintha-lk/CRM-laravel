<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Location::create([
            'name' => 'Location 1',
            'address' => 'Address 1',
            'telephone_number' => '1234567890',
            'status' => true,
        ]);

        Location::create([
            'name' => 'Location 2',
            'address' => 'Address 2',
            'telephone_number' => '1234567890',
            'status' => true,
        ]);

        Location::create([
            'name' => 'Location 3',
            'address' => 'Address 3',
            'telephone_number' => '1234567890',
            'status' => true,
        ]);

        Location::create([
            'name' => 'Location 4',
            'address' => 'Address 4',
            'telephone_number' => '1234567890',
            'status' => true,
        ]);
    }
}
