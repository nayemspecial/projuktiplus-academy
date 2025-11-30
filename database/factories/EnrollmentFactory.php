<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->student(),
            'course_id' => Course::factory(),
            'price_paid' => fn (array $attributes) => Course::find($attributes['course_id'])->discount_price ?? Course::find($attributes['course_id'])->price,
            'status' => 'active',
            'progress' => $this->faker->numberBetween(0, 100),
            'completed_lessons' => $this->faker->numberBetween(0, 10),
            'total_lessons' => fn (array $attributes) => Course::find($attributes['course_id'])->total_lessons,
            'completed_at' => null,
            'last_accessed_at' => now(),
            'cancellation_reason' => null,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'progress' => 100,
            'completed_at' => now(),
        ]);
    }
}