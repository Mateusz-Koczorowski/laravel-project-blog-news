<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DefaultUsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'role' => 'Admin',
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'password' => env('ADMIN_PASSWORD'),
            ],
            [
                'role' => 'Author',
                'name' => env('AUTHOR_NAME'),
                'email' => env('AUTHOR_EMAIL'),
                'password' => env('AUTHOR_PASSWORD'),
            ],
            [
                'role' => 'Reader',
                'name' => env('READER_NAME'),
                'email' => env('READER_EMAIL'),
                'password' => env('READER_PASSWORD'),
            ],
        ];

        foreach ($users as $userData) {
            if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
                Log::error("Brakujące dane dla roli: {$userData['role']} w .env");
                throw new \Exception("Brakujące dane w .env dla roli: {$userData['role']}");
            }
            
            if (!User::where('email', $userData['email'])->exists()) {
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role'],
                ]);

                Log::info("Utworzono użytkownika: {$userData['email']} z rolą {$userData['role']}");
            }
        }
    }
}
