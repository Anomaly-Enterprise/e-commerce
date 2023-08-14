<?php
include 'include/db_connection.php';

// Retrieve data from POST parameters
$paymentID = isset($_POST['paymentID']) ? $_POST['paymentID'] : '';
$subTotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : '';
$coupon = isset($_POST['coupon']) ? $_POST['coupon'] : '';
$test_Total = isset($_POST['test_total']) ? $_POST['test_total'] : '';

// Retrieve user data from cookie
$email = $_COOKIE['email'];
$row = "";
$query = "SELECT * FROM tbl_member WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

// Retrieve cart data from POST parameter
$encodedCartData = $_POST['cart_data_for_php'];
$decodedCartData = json_decode(urldecode($encodedCartData), true);

$username = $row['username'];
$email = $row['email'];
$mobile = $row['mobile'];
$address = $row['address'];
$city = $row['city'];
$state = $row['state'];
$zip = $row['zip'];
$paymentID = $paymentID;
    
$sql_user_data = "INSERT INTO checkout_user_data (user_name, user_email, user_phone, user_address, user_city, user_state, user_zip, payment_id) VALUES ('$username', '$email', '$mobile', '$address', '$city', '$state', '$zip', '$paymentID')";

if ($conn->query($sql_user_data) === TRUE) {
    echo "User information inserted successfully";
} else {
    echo "Error: " . $sql_user_data . "<br>" . $conn->error;
}

foreach ($decodedCartData as $key => $product) {
    $product_name = $product['productName'];
    $product_quantity = $product['productQuantity'];
    $product_size = $product['productSize'];
    $product_price = $product['productPrice'];

    $sql_cart_data = "INSERT INTO checkout_cart_data (product_name, product_size, product_price, product_quantity, subtotal_amount, coupon_code, total_amount, payment_id) VALUES ('$product_name', '$product_size', '$product_price', '$product_quantity', '$subTotal', '$coupon','$test_Total','$paymentID')";
    if ($conn->query($sql_cart_data) === TRUE) {
        echo "Cart information inserted successfully";
    } else {
        echo "Error: " . $sql_cart_data . "<br>" . $conn->error;
    }  
} 
$sql_join = "SELECT checkout_user_data.user_name, checkout_user_data.user_email, checkout_user_data.user_phone, checkout_user_data.user_address, checkout_user_data.user_city, checkout_user_data.user_state, checkout_user_data.user_zip, checkout_user_data.payment_id, checkout_cart_data.product_name, checkout_cart_data.product_size, checkout_cart_data.product_price, checkout_cart_data.product_quantity, checkout_cart_data.subtotal_amount, checkout_cart_data.coupon_code, checkout_cart_data.total_amount, checkout_cart_data.payment_id FROM checkout_user_data, checkout_cart_data WHERE checkout_user_data.payment_id = checkout_cart_data.payment_id";
$result_join = $conn->query($sql_join);
while ($row_join = $result_join->fetch_assoc()) { 
    $user_name = $row_join['user_name'];
    $user_email = $row_join['user_email'];
    $user_phone = $row_join['user_phone'];
    $user_address = $row_join['user_address'];
    $user_city = $row_join['user_city'];
    $user_state = $row_join['user_state'];  
    $user_zip = $row_join['user_zip'];
    $payment_id = $row_join['payment_id'];
    $product_name = $row_join['product_name'];
    $product_size = $row_join['product_size'];
    $product_price = $row_join['product_price'];
    $product_quantity = $row_join['product_quantity'];
    $subtotal_amount = $row_join['subtotal_amount'];
    $coupon_code = $row_join['coupon_code'];
    $total_amount = $row_join['total_amount'];
    $payment_id = $row_join['payment_id'];
    $sql_total_data =  "INSERT INTO checkout_total_data (user_name, user_email, user_phone, user_address, user_city, user_state, user_zip, payment_id, product_name, product_size, product_price, product_quantity, subtotal_amount, coupon_code, total_amount, cart_payment_id)
    VALUES ('$user_name', '$user_email', '$user_phone', '$user_address', '$user_city', '$user_state', '$user_zip', '$payment_id', '$product_name', '$product_size', '$product_price', '$product_quantity', '$subtotal_amount', '$coupon_code', '$total_amount', '$payment_id')";
    if ($conn->query($sql_total_data) === TRUE) {
        echo "Total information inserted successfully";
    } else {
        echo "Error: " . $sql_total_data . "<br>" . $conn->error;
    }
}
?>
