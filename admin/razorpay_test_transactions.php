<?php
// razorpay_test_transactions.php

// Replace these with your actual Razorpay Test API credentials
$razorpayKey = 'rzp_test_fVL3GNctoay03F';
$razorpaySecret = 'RJg1zHGSGKxiN9rwFMiwagDE';

// Function to fetch latest test transactions using Razorpay API
function fetchLatestTestTransactions($razorpayKey, $razorpaySecret) {
    $url = 'https://api.razorpay.com/v1/payments';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, $razorpayKey . ':' . $razorpaySecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Check if the response is valid JSON
    $decodedResponse = json_decode($response, true);

    // Check if 'items' key exists in the decoded response
    if (isset($decodedResponse['items']) && is_array($decodedResponse['items'])) {
        return $decodedResponse['items'];
    } else {
        // Return an empty array or handle the error as per your requirement
        return [];
    }
}

// Fetch latest test transactions
$latestTestTransactions = fetchLatestTestTransactions($razorpayKey, $razorpaySecret);
?>
