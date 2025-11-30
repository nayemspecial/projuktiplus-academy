<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $bangladeshiTitles = [
            'লারাভেল দিয়ে ওয়েব ডেভেলপমেন্ট', 
            'রিয়েক্ট জেএস সম্পূর্ণ গাইড',
            'পাইথন প্রোগ্রামিং শিখুন',
            'ডাটা সায়েন্স এবং মেশিন লার্নিং',
            'ওয়ার্ডপ্রেস থিম ডেভেলপমেন্ট'
        ];

        return [
            'title' => $this->faker->randomElement($bangladeshiTitles),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraphs(3, true),
            'short_description' => $this->faker->sentence(),
            'instructor_id' => User::factory()->instructor(),
            'thumbnail' => 'courses/thumbnails/default.jpg',
            'video_preview' => null,
            'price' => $this->faker->randomElement([0, 1000, 2000, 3000]),
            'discount_price' => $this->faker->optional(0.3)->randomElement([500, 1500, 2500]),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'status' => 'published',
            'category' => $this->faker->randomElement(['web-development', 'data-science', 'mobile-development', 'ux-ui']),
            'language' => 'bangla',
            'duration' => $this->faker->randomElement(['10 hours', '20 hours', '30 hours']),
            'total_lessons' => $this->faker->numberBetween(10, 30),
            'total_students' => $this->faker->numberBetween(0, 500),
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'total_reviews' => $this->faker->numberBetween(0, 100),
            'requirements' => json_encode(['বেসিক কম্পিউটার জ্ঞান', 'ইন্টারনেট সংযোগ']),
            'what_you_will_learn' => json_encode(['প্রফেশনাল ডেভেলপমেন্ট', 'রিয়েল ওয়ার্ল্ড প্রোজেক্ট']),
            'target_audience' => json_encode(['বিগিনার', 'স্টুডেন্ট', 'ফ্রিল্যান্সার']),
            'featured' => $this->faker->boolean(20),
            'certificate_included' => true,
            'lifetime_access' => true,
            'published_at' => now(),
        ];
    }

    public function free(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => 0,
            'discount_price' => null,
        ]);
    }
}