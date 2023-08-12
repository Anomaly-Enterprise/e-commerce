<?php
include 'include/db_connection.php';

// Retrieve data from URL parameters
$paymentID = isset($_GET['paymentID']) ? $_GET['paymentID'] : '';
$subTotal = isset($_GET['subtotal']) ? $_GET['subtotal'] : '';
// $total = isset($_GET['total']) ? $_GET['total'] : '';
$coupon = isset($_GET['coupon']) ? $_GET['coupon']:'';
$test_Total = isset($_GET['test_total']) ? $_GET['test_total'] : '';

// Retrieve user data from cookie
$email = $_COOKIE['email'];
$row = "";
$query = "SELECT * FROM tbl_member WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

// Retrieve cart data from URL parameter
$encodedCartData = $_GET['cart_data_for_php'];
$decodedCartData = json_decode(urldecode($encodedCartData), true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Test</title>
</head>
<body>
    <h1>Checkout Test Page</h1>
    
    <h2>User Information</h2>
    <p>Name: <?php echo $row['username']; ?></p>
    <p>Email: <?php echo $row['email']; ?></p>
    <p>Phone: <?php echo $row['mobile']; ?></p>
    <p>Address: <?php echo $row['address']; ?></p>
    <p>City: <?php echo $row['city']; ?></p>
    <p>State: <?php echo $row['state']; ?></p>
    <p>Zip: <?php echo $row['zip']; ?></p>

    <!-- Display other user information as needed -->

    <h2>Cart Data</h2>
    <ul>
        <?php foreach ($decodedCartData as $key => $product) { ?>
            <li>
                <?php echo $product['productName']; ?> -
                Price: <?php echo $product['productPrice']; ?> -
                Quantity: <?php echo $product['productQuantity']; ?>
            </li>
        <?php } ?>
    </ul>
    
    <h2>Payment Details</h2>
    <p>Payment ID: <?php echo $paymentID; ?></p>
    <p>Applied Coupon: <?php echo $coupon; ?></p>
    <p>Subtotal: <?php echo $subTotal; ?></p>
    <p>Total: <?php echo $test_Total; ?></p>
    <a href="cart.php">Go to Home</a>    <!-- Add your HTML content here -->
</body>
</html>
