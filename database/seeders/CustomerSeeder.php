<?php

// CustomerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'customer_id' => Str::ulid(),
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'phone' => '2024-01-15',
            'address' => '2024-01-15'
        ]);

        Customer::create([
            'customer_id' => Str::ulid(),
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'phone' => '2024-01-16',
            'address' => '2024-01-16'
        ]);

        Customer::create([
            'customer_id' => Str::ulid(),
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
            'password' => 'password123',
            'phone' => '2024-01-17',
            'address' => '2024-01-17'
        ]);
    }
}
