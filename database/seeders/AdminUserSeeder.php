<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'mommyybakery@gmail.com'],
            [
                'name'              => 'Admin Mommy Bakery',
                'password'          => Hash::make(env('ADMIN_PASSWORD')),
                'phone'             => env('ADMIN_PHONE'),
                'is_admin'          => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
