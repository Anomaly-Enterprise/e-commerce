<?php
include 'include/db_connection.php';

$firstname = "";
$email = "";
$phone = "";
$address = "";
$city = "";
$state = "";
$zip = "";
$cartData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Retrieve cart data
    $cartData = json_decode($_POST['cart_data_for_php'], true);
}

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Head section content -->
</head>
<body>
    <h1>Checkout Details</h1>
    <p><strong>Name:</strong> <?php echo $firstname; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Phone:</strong> <?php echo $phone; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>City:</strong> <?php echo $city; ?></p>
    <p><strong>State:</strong> <?php echo $state; ?></p>
    <p><strong>Zip:</strong> <?php echo $zip; ?></p>

    <h2>Cart Items:</h2>
    <ul>
        <?php foreach ($cartData as $key => $value) { ?>
            <li>
                <?php echo $value['productName']; ?> -
                Price: <?php echo $value['productPrice']; ?> -
                Quantity: <?php echo $value['productQuantity']; ?>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
