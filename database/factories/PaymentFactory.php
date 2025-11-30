<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $amount = $this->faker->randomElement([1000, 2000, 3000]);
        
        return [
            'user_id' => User::factory()->student(),
            'course_id' => Course::factory(),
            'transaction_id' => 'txn_' . $this->faker->unique()->uuid(),
            'payment_gateway' => $this->faker->randomElement(['bkash', 'nagad', 'rocket']),
            'amount' => $amount,
            'gateway_fee' => $amount * 0.02,
            'platform_fee' => $amount * 0.15,
            'instructor_earnings' => $amount * 0.83,
            'currency' => 'BDT',
            'status' => 'completed',
            'payment_details' => json_encode(['method' => 'mobile_banking']),
            'refund_details' => null,
            'completed_at' => now(),
            'refunded_at' => null,
        ];
    }
}