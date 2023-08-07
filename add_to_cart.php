<?php
// Retrieve the product data from the POST request
$productName = $_POST['product_name'];
$productPrice = $_POST['product_price'];
$productSize = $_POST['product_size'];
$productQuantity = $_POST['product_quantity'];

// You can now store this data in the cart using session or database, based on your requirements.
// For example, you can use session to store the cart data temporarily:
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add the product to the cart
$_SESSION['cart'][] = array(
    'product_name' => $productName,
    'product_price' => $productPrice,
    'product_quantity' => $productQuantity,
    'product_size' => $productSize
);

// Return a response to the frontend (optional)
echo "Product added to cart successfully.";
?>
