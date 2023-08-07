<?php
// show_member_log.php

// Include the database connection file
include '../include/db_connection.php';

// Function to store transaction data in the database
function storeTransaction($conn, $transaction)  {
    // var_dump($transaction);
    $id = $transaction['id'];
    $amount = $transaction['amount'] / 100;
    $currency = $transaction['currency'];
    $status = $transaction['status'];

    // Prepare the SQL query
    $query = "INSERT INTO transaction_data (transaction_id, amount, currency, status) VALUES ('$id', '$amount', '$currency', '$status')";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        // echo "Transaction with ID $id has been stored successfully.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Include razorpay_test_transactions.php to fetch the transactions
include 'razorpay_test_transactions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Test Transactions</title>
</head>
<body>
<h1>Razorpay Test Transactions</h1>
    <table>
        <tr>
            <th>Transaction ID</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Date and Time</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php foreach ($latestTestTransactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction['id']; ?></td>
                <td><?php echo $transaction['amount'] / 100; ?></td>
                <td><?php echo $transaction['currency']; ?></td>
                <td><?php echo $transaction['status']; ?></td>
                <td><?php echo $transaction['method']; ?></td>
                <td><?php echo date('Y-m-d H:i:s', $transaction['created_at']); ?></td>
                <!-- Add more columns as needed -->
            </tr>
            <?php
            // Store the transaction in the database
            storeTransaction($conn, $transaction);
            ?>
        <?php endforeach; ?>
    </table>

    <br><br>

    <?php
    

    // Fetch data from the tbl_member_log table
    $query = "SELECT * FROM tbl_member_logs";
    $result = $conn->query($query);
    ?>
    <h1>Member Log Table</h1>
    <table>
        <tr>
            <!-- <th>Log ID</th> -->
            <th>Username</th>
            <th>Email</th>
            <th>Timestamp</th>
        </tr>
        <?php while ($log = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $log['username']; ?></td>
                <td><?php echo $log['email']; ?></td>
                <td><?php echo $log['time']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
