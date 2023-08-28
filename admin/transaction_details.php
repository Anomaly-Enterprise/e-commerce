<!-- transaction_details.php -->

<?php
// Include the database connection file
include '../include/db_connection.php';

// Fetch all transactions from the database
$sql = "SELECT * FROM checkout_total_data";
$result = mysqli_query($conn, $sql);
$existingTransactions = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $existingTransactions[$row['payment_id']] = $row; // Use transaction_id as the key
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction Details</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_dashboard.css">
</head>
<body>
<h1>Checkout Total Data</h1>
<div class="table-container">
<table class="table">
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>User Name</th>
        <th>User Email</th>
        <th>User Phone</th>
        <th>User Address</th>
        <th>User City</th>
        <th>User State</th>
        <th>User ZIP</th>
        <!-- <th>Payment ID</th> -->
        <th>Product Name</th>
        <th>Product Size</th>
        <th>Product Price</th>
        <th>Product Quantity</th>
        <th>Subtotal Amount</th>
        <th>Coupon Code</th>
        <th>Total Amount</th>
        <th>Payment ID</th>
        <th>Time</th>
        <!-- Add more columns as needed -->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($existingTransactions as $transaction): ?>
        <tr>
            <td><?php echo $transaction['order_id']; ?></td>
            <td><?php echo $transaction['customer_id']; ?></td>
            <td><?php echo $transaction['user_name']; ?></td>
            <td><?php echo $transaction['user_email']; ?></td>
            <td><?php echo $transaction['user_phone']; ?></td>
            <td><?php echo $transaction['user_address']; ?></td>
            <td><?php echo $transaction['user_city']; ?></td>
            <td><?php echo $transaction['user_state']; ?></td>
            <td><?php echo $transaction['user_zip']; ?></td>
            <td><?php echo $transaction['product_name']; ?></td>
            <td><?php echo $transaction['product_size']; ?></td>
            <td><?php echo $transaction['product_price']; ?></td>
            <td><?php echo $transaction['product_quantity']; ?></td>
            <td><?php echo $transaction['subtotal_amount']; ?></td>
            <td><?php echo $transaction['coupon_code']; ?></td>
            <td><?php echo $transaction['total_amount']; ?></td>
            <td><?php echo $transaction['cart_payment_id']; ?></td>
            <td><?php echo $transaction['time']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

</body>
</html>
