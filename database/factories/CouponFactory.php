<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->bothify('???###')),
            'description' => $this->faker->sentence(),
            'type' => 'percentage',
            'value' => $this->faker->randomElement([10, 15, 20, 25]),
            'min_order_amount' => 1000,
            'max_uses' => 100,
            'used_count' => 0,
            'valid_from' => now(),
            'valid_to' => now()->addMonths(3),
            'is_active' => true,
            'applicable_courses' => null,
            'applicable_users' => null,
        ];
    }
}