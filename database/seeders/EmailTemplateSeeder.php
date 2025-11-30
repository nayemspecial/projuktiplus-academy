<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'key' => 'user_registration',
                'name' => 'নতুন ইউজার রেজিস্ট্রেশন',
                'subject' => 'স্বাগতম আমাদের প্লাটফর্মে!',
                'body' => '<p>প্রিয় <strong>{name}</strong>,</p><p>আমাদের সাথে যুক্ত হওয়ার জন্য ধন্যবাদ। আপনার অ্যাকাউন্টটি সফলভাবে তৈরি হয়েছে।</p><p>ধন্যবাদান্তে,<br>প্রযুক্তি প্লাস টিম</p>',
                'variables' => ['{name}', '{email}', '{app_name}'],
            ],
            [
                'key' => 'course_enrollment',
                'name' => 'কোর্স এনরোলমেন্ট কনফার্মেশন',
                'subject' => 'কোর্স এনরোলমেন্ট সফল হয়েছে',
                'body' => '<p>প্রিয় <strong>{name}</strong>,</p><p>অভিনন্দন! আপনি সফলভাবে <strong>{course_name}</strong> কোর্সে এনরোল করেছেন।</p><p>এখনই শেখা শুরু করুন!</p>',
                'variables' => ['{name}', '{course_name}', '{price}'],
            ],
            [
                'key' => 'payment_success',
                'name' => 'পেমেন্ট সাকসেসফুল',
                'subject' => 'পেমেন্ট রিসিভড',
                'body' => '<p>প্রিয় {name},</p><p>আপনার পেমেন্ট (TrxID: {transaction_id}) সফলভাবে সম্পন্ন হয়েছে।</p>',
                'variables' => ['{name}', '{transaction_id}', '{amount}'],
            ],
            [
                'key' => 'certificate_issued',
                'name' => 'সার্টিফিকেট ইস্যু',
                'subject' => 'আপনার সার্টিফিকেট তৈরি হয়েছে',
                'body' => '<p>প্রিয় {name},</p><p>অভিনন্দন! আপনি {course_name} সফলভাবে শেষ করেছেন। আপনার সার্টিফিকেটটি তৈরি হয়েছে।</p>',
                'variables' => ['{name}', '{course_name}', '{certificate_link}'],
            ],
        ];

        foreach ($templates as $template) {
            EmailTemplate::updateOrCreate(['key' => $template['key']], $template);
        }
    }
}