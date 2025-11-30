<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseAnalyticFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'total_enrollments' => $this->faker->numberBetween(10, 500),
            'active_enrollments' => function (array $attributes) {
                return $this->faker->numberBetween(5, $attributes['total_enrollments']);
            },
            'completed_enrollments' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['active_enrollments']);
            },
            'completion_rate' => $this->faker->randomFloat(2, 0, 100),
            'average_rating' => $this->faker->randomFloat(2, 3, 5),
            'total_reviews' => $this->faker->numberBetween(0, 100),
            'revenue' => $this->faker->numberBetween(10000, 500000),
            'analytics_date' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
        ];
    }

    public function forDate($date): static
    {
        return $this->state(fn (array $attributes) => [
            'analytics_date' => $date,
        ]);
    }

    public function withHighPerformance(): static
    {
        return $this->state(fn (array $attributes) => [
            'completion_rate' => $this->faker->randomFloat(2, 70, 100),
            'average_rating' => $this->faker->randomFloat(2, 4, 5),
            'revenue' => $this->faker->numberBetween(100000, 500000),
        ]);
    }
}