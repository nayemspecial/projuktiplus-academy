<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        // প্রথম অ্যাডমিন ইউজারকে খুঁজে বের করা হচ্ছে (যাতে তাকেই নোটিফিকেশন দেওয়া যায়)
        $admin = User::where('role', 'admin')->first(); 
        // অথবা নির্দিষ্ট আইডির জন্য: $admin = User::find(1);

        if (!$admin) {
            $this->command->info('কোনো অ্যাডমিন ইউজার পাওয়া যায়নি! দয়া করে আগে ইউজার তৈরি করুন।');
            return;
        }

        $notifications = [
            [
                'type' => 'order',
                'title' => 'নতুন অর্ডার এসেছে',
                'message' => 'অর্ডার #INV-1001 সফলভাবে পেমেন্ট করা হয়েছে।',
                'data' => ['url' => '/admin/payments'], // টেস্ট লিংকে রিডাইরেক্ট হবে
                'is_read' => false,
            ],
            [
                'type' => 'user',
                'title' => 'নতুন শিক্ষার্থী রেজিস্ট্রেশন',
                'message' => 'রাহিম আহমেদ নতুন স্টুডেন্ট হিসেবে জয়েন করেছেন।',
                'data' => ['url' => '/admin/users/students'],
                'is_read' => false,
            ],
            [
                'type' => 'course',
                'title' => 'কোর্স কমপ্লিট',
                'message' => 'সাদিয়া ইসলাম "Python Basic" কোর্সটি সম্পন্ন করেছেন।',
                'data' => null, // কোনো লিংক নেই
                'is_read' => true,
                'read_at' => now()->subHours(2),
            ],
            [
                'type' => 'system',
                'title' => 'সিস্টেম আপডেট',
                'message' => 'আগামীকাল রাত ১২টায় সার্ভার মেইনটেনেন্স করা হবে।',
                'data' => null,
                'is_read' => false,
            ],
             [
                'type' => 'order',
                'title' => 'পেমেন্ট ফেইলড',
                'message' => 'ট্রানজেকশন #Tx12345 ফেইল হয়েছে।',
                'data' => ['url' => '/admin/payments'],
                'is_read' => false,
            ],
        ];

        foreach ($notifications as $n) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => $n['type'],
                'title' => $n['title'],
                'message' => $n['message'],
                'data' => $n['data'],
                'is_read' => $n['is_read'],
                'read_at' => $n['is_read'] ? $n['read_at'] : null,
            ]);
        }
    }
}