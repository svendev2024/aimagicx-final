<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentPlatform;

class PaymentPlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            ['id' => 1, 'name' => 'PayPal', 'image' => 'img/payments/paypal.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 2, 'name' => 'Stripe', 'image' => 'img/payments/stripe.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 3, 'name' => 'BankTransfer', 'image' => 'img/payments/bank-transfer.png', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 4, 'name' => 'Paystack', 'image' => 'img/payments/paystack.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 5, 'name' => 'Razorpay', 'image' => 'img/payments/razorpay.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 6, 'name' => 'Braintree', 'image' => 'img/payments/braintree.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 7, 'name' => 'Mollie', 'image' => 'img/payments/mollie.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 8, 'name' => 'Coinbase', 'image' => 'img/payments/coinbase.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 9, 'name' => 'Midtrans', 'image' => 'img/payments/midtrans.png', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 10, 'name' => 'Flutterwave', 'image' => 'img/payments/flutterwave.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 11, 'name' => 'Yookassa', 'image' => 'img/payments/yookassa.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 12, 'name' => 'Paddle', 'image' => 'img/payments/paddle.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 13, 'name' => 'MercadoPago', 'image' => 'img/payments/mercadopago.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 14, 'name' => '2Checkout', 'image' => 'img/payments/2checkout.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 15, 'name' => 'WePay', 'image' => 'img/payments/wepay.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 16, 'name' => 'Robokassa', 'image' => 'img/payments/robokassa.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 17, 'name' => 'Paytm', 'image' => 'img/payments/paytm.svg', 'enabled' => false, 'subscriptions_enabled' => false],
            ['id' => 18, 'name' => 'Alipay', 'image' => 'img/payments/paytm.svg', 'enabled' => false, 'subscriptions_enabled' => false],
        ];

        foreach ($platforms as $platform) {
            PaymentPlatform::updateOrCreate(['id' => $platform['id']], $platform);
        }
    }
}
