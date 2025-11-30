<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        $titles = ['কোর্স ওভারভিউ', 'ইনস্টলেশন', 'বেসিক সিনট্যাক্স', 'প্র্যাকটিকাল উদাহরণ'];
        
        return [
            'section_id' => Section::factory(),
            'title' => $this->faker->randomElement($titles),
            'slug' => $this->faker->unique()->slug(),
            'content' => $this->faker->paragraphs(2, true),
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'video_duration' => $this->faker->randomElement(['10:30', '15:45', '20:00']),
            'video_type' => 'youtube',
            'attachments' => null,
            'order' => $this->faker->numberBetween(1, 20),
            'is_free' => $this->faker->boolean(20),
            'is_published' => true,
            'preview' => $this->faker->boolean(10),
            'published_at' => now(),
        ];
    }
}