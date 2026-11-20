<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create a normal test user
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        // Admin accounts
        $admins = [
            [
                'name' => 'Omar',
                'email' => 'omar@example.com',
                'password' => 'Omar123456',
            ],
            [
                'name' => 'Ziad',
                'email' => 'ziad@example.com',
                'password' => 'Ziad123456',
            ],
            [
                'name' => 'Ali',
                'email' => 'ali@example.com',
                'password' => 'Ali123456',
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role' => 'admin',
                ]
            );
        }
    }
}
