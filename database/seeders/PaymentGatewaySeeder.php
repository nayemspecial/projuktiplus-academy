<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class PaymentGatewaySeeder extends Seeder
{
    public function run(): void
    {
        $gateways = [
            [
                'name' => 'stripe',
                'title' => 'Stripe Payment',
                'is_active' => true,
                'test_mode' => true,
                'credentials' => [
                    'publishable_key' => '',
                    'secret_key' => '',
                ],
            ],
            [
                'name' => 'paypal',
                'title' => 'PayPal',
                'is_active' => false,
                'test_mode' => true,
                'credentials' => [
                    'client_id' => '',
                    'client_secret' => '',
                    'app_id' => '',
                ],
            ],
            [
                'name' => 'sslcommerz',
                'title' => 'SSLCommerz',
                'is_active' => false,
                'test_mode' => true,
                'credentials' => [
                    'store_id' => '',
                    'store_password' => '',
                ],
            ],
            [
                'name' => 'manual',
                'title' => 'ব্যাংক / মোবাইল ব্যাংকিং (ম্যানুয়াল)',
                'is_active' => true,
                'test_mode' => false,
                'credentials' => [
                    'bank_info' => 'বিকাশ: 017xxxxxxxx (পার্সোনাল)',
                    'instructions' => 'টাকা পাঠিয়ে ট্রানজেকশন আইডি সাবমিট করুন।',
                ],
            ],
        ];

        foreach ($gateways as $gateway) {
            PaymentGateway::updateOrCreate(['name' => $gateway['name']], $gateway);
        }
    }
}