<?php
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
include '../include/db_connection.php';
// Fetch existing transactions from the database
$sql = "SELECT * FROM transaction_data";
$result = mysqli_query($conn, $sql);
$existingTransactions = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $existingTransactions[] = $row['transaction_id'];
    }
}

// Fetch latest test transactions from API
$latestTestTransactions = fetchLatestTestTransactions($razorpayKey, $razorpaySecret);

// Compare and insert new transactions
$newTransactions = [];
foreach ($latestTestTransactions as $transaction) {
    if (!in_array($transaction['id'], $existingTransactions)) {
        // Insert the new transaction into the database
        $transactionId = $transaction['id'];
        $amount = $transaction['amount'];
        $currency = $transaction['currency'];
        // Add more fields as needed

        $insertSql = "INSERT INTO transaction_data (transaction_id, amount, currency) 
                      VALUES ('$transactionId', '$amount', '$currency')";
        $insertResult = mysqli_query($conn, $insertSql);
        if ($insertResult) {
            $newTransactions[] = $transactionId;
        }
    }
}

// Close the database connection
mysqli_close($conn);

// Output new transactions (optional)
// echo "New Transactions Inserted: " . implode(', ', $newTransactions);
?>
