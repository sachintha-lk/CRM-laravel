<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRolesEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $userroles = [
            [   
                'id' => UserRolesEnum::Customer,
                'name' => 'Customer',
                'status' => true,
            ],
            [
                'id' => UserRolesEnum::Employee,
                'name' => 'Employee',
                'status' => true,
            ],
            [
                'id' => UserRolesEnum::Admin,
                'name' => 'Admin',
                'status' => true,
            ]

        ];

        foreach ($userroles as $role) {
            \App\Models\Role::create($role);
        }

        // Create admin user
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@salonbliss.com',
            'password' => Hash::make('adminpassword'),
            'role_id' => UserRolesEnum::Admin,
        ]);

        // create mock customers
        \App\Models\User::create([
            'name' => 'Customer 1',
            'email' => 'cust1@gmail.com',
            'password' => Hash::make('custpassword'),
            'role_id' => UserRolesEnum::Customer,
        ]);
        
        \App\Models\User::create([
            'name' => 'Customer 2',
            'email' => 'cust2@gmail.com',
            'password' => Hash::make('custpassword'),
            'role_id' => UserRolesEnum::Customer,
        ]);

        \App\Models\User::create([
            'name' => 'Customer 3',
            'email' => 'cust3@gmail.com',
            'password' => Hash::make('custpassword'),
            'role_id' => UserRolesEnum::Customer,
        ]); 


        // create mock employees
        \App\Models\User::create([
            'name' => 'Employee 1',
            'email' => 'emp1@salonbliss.com',
            'password' => Hash::make('emppassword'),
            'role_id' => UserRolesEnum::Employee,
        ]);

        \App\Models\User::create([
            'name' => 'Employee 2',
            'email' => 'emp2@salonbliss.com',
            'password' => Hash::make('emppassword'),
            'role_id' => UserRolesEnum::Employee,
        ]);


    }
}
