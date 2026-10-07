<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin
        $admin = User::create([
            'role' => 'admin',
            'name' => 'Coffee Base Admin',
            'first_name' => 'Coffee Base',
            'last_name' => 'Admin',
            'email' => 'admin@coffeebase.ph',
            'phone' => '09171234567',
            'password' => Hash::make('admin12345'),
            'company' => 'Coffee Base Philippines',
            'address' => 'BGC Taguig',
            'barangay' => 'Fort Bonifacio',
            'city' => 'Taguig',
            'postal_code' => '1634',
            'region' => 'Metro Manila',
            'country' => 'Philippines',
        ]);
    }
}
