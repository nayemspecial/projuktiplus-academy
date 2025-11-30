<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawalFactory extends Factory
{
    public function definition(): array
    {
        $paymentMethods = ['bank', 'bKash', 'Nagad', 'Rocket'];
        
        return [
            'instructor_id' => User::factory()->instructor(),
            'amount' => $this->faker->numberBetween(5000, 50000),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'account_name' => $this->faker->name,
            'account_number' => $this->faker->bankAccountNumber,
            'bank_name' => $this->faker->optional(0.7)->company,
            'branch_name' => $this->faker->optional(0.5)->city,
            'mobile_wallet' => $this->faker->optional(0.5)->phoneNumber,
            'status' => $this->faker->randomElement(['pending', 'approved', 'processed', 'rejected']),
            'notes' => $this->faker->optional(0.3)->sentence,
            'processed_at' => $this->faker->optional(0.4)->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'processed_at' => null,
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'processed_at' => null,
        ]);
    }

    public function processed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'processed',
            'processed_at' => now(),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'notes' => $this->faker->sentence,
        ]);
    }
}