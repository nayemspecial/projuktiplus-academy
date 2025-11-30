<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::factory()->create([
            'name' => 'নাঈমুর রহমান',
            'email' => 'admin@projuktiplus.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '01712345678',
        ]);

        // Create 5 Instructors
        User::factory()->count(5)->instructor()->create();

        // Create 20 Students
        User::factory()->count(20)->student()->create();

        $this->command->info('✅ Users seeded: 1 Admin + 5 Instructors + 20 Students');
    }
}