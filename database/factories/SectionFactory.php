<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    public function definition(): array
    {
        $titles = ['ইন্ট্রোডাকশন', 'বেসিক কনসেপ্ট', 'এডভান্সড টপিক্স', 'প্র্যাকটিকাল প্রোজেক্ট'];
        
        return [
            'course_id' => Course::factory(),
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->sentence(),
            'order' => $this->faker->numberBetween(1, 10),
            'is_published' => true,
        ];
    }
}