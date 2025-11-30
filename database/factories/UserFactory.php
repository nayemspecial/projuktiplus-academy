<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $bangladeshiNames = [
            'আহমেদ রফিক', 'ফাতেমা আক্তার', 'মোহাম্মদ আলী', 'সালমা খাতুন', 'জaved করিম', 
            'নুসরাত জাহান', 'রহমান মিয়া', 'শারমিন আক্তার', 'ইমরান হোসেন', 'আয়শা সিদ্দিকা'
        ];

        return [
            'name' => $this->faker->randomElement($bangladeshiNames),
            'email' => $this->faker->unique()->userName() . '@projuktiplus.com',
            'phone' => '01' . $this->faker->randomElement([3,4,5,6,7,8,9]) . $this->faker->numerify('#########'),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => null,
            'role' => $this->faker->randomElement(['student', 'instructor']),
            'status' => 'active',
            'bio' => $this->faker->paragraph(2),
            'website' => $this->faker->optional()->url(),
            'social_links' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'email' => 'admin@projuktiplus.com',
        ]);
    }

    public function instructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'instructor',
        ]);
    }

    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'student',
        ]);
    }
}