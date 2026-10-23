<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'pelanggan@kiabeauty.com'],
            [
                'name' => 'Kiara Cantika',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'siti@kiabeauty.com'],
            [
                'name' => 'Siti Rahma',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
