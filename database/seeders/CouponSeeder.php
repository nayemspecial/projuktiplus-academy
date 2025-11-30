<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\User;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        // Create active coupons
        Coupon::factory()->count(5)->create();

        // Create expired coupons
        Coupon::factory()->count(2)->create([
            'valid_to' => now()->subDays(10),
            'is_active' => false,
        ]);

        // Create some coupon usages
        $students = User::where('role', 'student')->get();
        $coupons = Coupon::where('is_active', true)->get();

        foreach ($students as $student) {
            // 20% chance to use a coupon
            if (rand(1, 100) <= 20 && $coupons->isNotEmpty()) {
                $coupon = $coupons->random();
                
                CouponUsage::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => $student->id,
                    'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
                    'discount_amount' => $coupon->value,
                ]);

                $coupon->increment('used_count');
            }
        }

        $this->command->info('✅ Coupons and usages created');
    }
}