<?php

namespace Database\Seeders;

use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Database\Seeder;

class WithdrawalSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = User::where('role', 'instructor')->get();

        foreach ($instructors as $instructor) {
            // Each instructor has 1-3 withdrawal requests
            $withdrawalCount = rand(1, 3);
            
            Withdrawal::factory()->count($withdrawalCount)->create([
                'instructor_id' => $instructor->id,
            ]);
        }

        $this->command->info('✅ Withdrawal requests created for instructors');
        $this->command->info('💰 Total Withdrawals: ' . Withdrawal::count());
    }
}