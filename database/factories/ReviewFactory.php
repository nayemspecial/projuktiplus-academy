<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $comments = [
            'অসাধারণ কোর্স, অনেক কিছু শিখলাম!',
            'ইনস্ট্রাক্টর খুব ভালো explain করেন।',
            'প্র্যাকটিকাল প্রোজেক্ট গুলো খুব helpful।'
        ];

        return [
            'user_id' => User::factory()->student(),
            'course_id' => Course::factory(),
            'rating' => $this->faker->numberBetween(4, 5),
            'comment' => $this->faker->randomElement($comments),
            'is_approved' => true,
            'featured' => $this->faker->boolean(15),
            'helpful' => null,
            'not_helpful' => null,
        ];
    }
}