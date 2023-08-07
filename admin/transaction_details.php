<!-- transaction_details.php -->

<?php
// Include razorpay_test_transactions.php to fetch the transactions
include 'razorpay_test_transactions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction Details</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_dashboard.css">
</head>
<body>
<h1>Razorpay Test Transactions</h1>
<div class="table-container">
<table class="table">
    <thead>
    <tr>
        <th>Transaction ID</th>
        <th>Amount</th>
        <th>Currency</th>
        <th>Status</th>
        <th>Payment Method</th>
        <th>Date and Time</th>
        <!-- Add more columns as needed -->
    </tr>
    </thead>
    <tbody>
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
    </tbody>
</table>
</div>

</body>
</html>