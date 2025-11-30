<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        $students = User::where('role', 'student')->pluck('id');
        $instructors = User::where('role', 'instructor')->pluck('id');
        
        $messages = [
            'কোর্স সম্পর্কে কিছু জানতে চাই',
            'লেকচারটি খুব ভালো হয়েছে',
            'পরীক্ষার তারিখ পরিবর্তন করা সম্ভব?',
            'অ্যাসাইনমেন্ট জমা দিতে সমস্যা হচ্ছে',
            'কোর্স মেটেরিয়াল সম্পর্কে প্রশ্ন আছে'
        ];

        return [
            'sender_id' => $this->faker->randomElement($students->merge($instructors)->toArray()),
            'receiver_id' => function (array $attributes) use ($students, $instructors) {
                return $attributes['sender_id'] instanceof User && $attributes['sender_id']->role === 'student'
                    ? $this->faker->randomElement($instructors->toArray())
                    : $this->faker->randomElement($students->toArray());
            },
            'course_id' => Course::factory(),
            'message' => $this->faker->randomElement($messages),
            'is_read' => $this->faker->boolean(60),
            'read_at' => $this->faker->optional(50)->dateTimeBetween('-1 week', 'now'),
        ];
    }

    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    public function fromStudentToInstructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'sender_id' => User::factory()->student(),
            'receiver_id' => User::factory()->instructor(),
        ]);
    }
}