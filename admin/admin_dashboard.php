<?php
// Include razorpay_test_transactions.php to fetch the transactions
include 'razorpay_test_transactions.php';

// Open a new MySQLi connection

include '../include/db_connection.php';

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
    <?php endforeach; ?>
</table>

<?php
// Fetch data from the tbl_member_log table
$query = "SELECT * FROM tbl_member_logs";
$result = $conn->query($query);
?>
<h1>Member Log Table</h1>
<table>
    <tr>
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

<?php
// Close the connection
mysqli_close($conn);
?>

</body>
</html>
