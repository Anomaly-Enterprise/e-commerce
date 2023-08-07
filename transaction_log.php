<?php
include 'include/db_connection.php';
// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample data to simulate transactions (replace this with your JavaScript implementation)
$transactions = [];

// Function to log transactions
function logTransaction($transactionData, $conn) {
    global $transactions;

    // Decode the JSON data into an associative array
    $transactionData = json_decode($transactionData, true);

    // Ensure the JSON decoding was successful
    if (!$transactionData) {
        echo json_encode(['error' => 'Invalid transaction data']);
        return;
    }

    // Escape and prepare data for insertion into the database
    $id = $conn->real_escape_string($transactionData['id']);
    $amount = $conn->real_escape_string($transactionData['amount']);
    $status = $conn->real_escape_string($transactionData['status']);
    $time = $conn->real_escape_string($transactionData['time']);

    // Insert the transaction data into the database
    $sql = "INSERT INTO transactions (id, amount, status, time) VALUES ('$id', '$amount', '$status', '$time')";
    if ($conn->query($sql) === TRUE) {
        $transactions[] = $transactionData;
        echo json_encode(['message' => 'Transaction logged successfully']);
    } else {
        echo json_encode(['error' => 'Error logging transaction: ' . $conn->error]);
    }
}

// Check if a transaction request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaction_data'])) {
    $transactionData = $_POST['transaction_data'];
    logTransaction($transactionData, $conn);
    exit;
}
?>

<!-- Rest of the HTML code -->
