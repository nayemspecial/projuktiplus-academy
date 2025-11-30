<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        $titles = [
            'কোর্স আপডেট নোটিশ',
            'নতুন লেকচার যোগ হয়েছে',
            'পরীক্ষার সময়সূচী',
            'জরুরী ঘোষণা',
            'কোর্স মেটেরিয়াল আপডেট'
        ];

        return [
            'course_id' => Course::factory(),
            'instructor_id' => User::factory()->instructor(),
            'title' => $this->faker->randomElement($titles),
            'content' => $this->faker->paragraphs(3, true),
            'is_published' => $this->faker->boolean(80),
            'is_urgent' => $this->faker->boolean(20),
            'published_at' => $this->faker->optional(70)->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_urgent' => true,
        ]);
    }
}