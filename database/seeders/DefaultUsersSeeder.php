<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', env('ADMIN_EMAIL'))->exists()) {
            User::create([
                'name' => env('ADMIN_NAME', 'Admin'),
                'email' => env('ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'zaq1@WSX')),
                'role' => 'Admin',
            ]);
        }

        if (!User::where('email', env('AUTHOR_EMAIL'))->exists()) {
            User::create([
                'name' => env('AUTHOR_NAME', 'Author'),
                'email' => env('AUTHOR_EMAIL', 'author@example.com'),
                'password' => Hash::make(env('AUTHOR_PASSWORD', 'zaq1@WSX')),
                'role' => 'Author',
            ]);
        }

        if (!User::where('email', env('READER_EMAIL'))->exists()) {
            User::create([
                'name' => env('READER_NAME', 'Reader'),
                'email' => env('READER_EMAIL', 'reader@example.com'),
                'password' => Hash::make(env('READER_PASSWORD', 'zaq1@WSX')),
                'role' => 'Reader',
            ]);
        }
    }
}
