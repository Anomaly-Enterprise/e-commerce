<?php

require 'razorpay-php-masterlibs/Requests-2.0.4/src/autoload.php'; // Include the SDK

use Razorpay\Api\Api;

$api_key = 'your_test_api_key';
$api_secret = 'your_test_api_secret';

// Initialize the Razorpay API with your test API key and secret
$api = new Api($api_key, $api_secret);

// Replace these with your actual data
$amount = 100; // Amount in paise (e.g., 100 paise = ₹1)
$currency = 'INR';
$payment_capture = 1; // Auto capture payment

// Create a test order
$order = $api->order->create(array(
    'amount' => $amount,
    'currency' => $currency,
    'payment_capture' => $payment_capture,
));

// Get the order ID
$order_id = $order['id'];

// Output the order ID (you can use it to proceed with payment on the front-end)
echo 'Test Order ID: ' . $order_id;
