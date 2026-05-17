<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ironpulse.com',
            'role' => 'admin',
            'bio' => 'Site administrator and fitness enthusiast.',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@ironpulse.com',
            'role' => 'user',
            'bio' => 'I love working out and sharing tips!',
        ]);

        User::factory(8)->create();
    }
}
