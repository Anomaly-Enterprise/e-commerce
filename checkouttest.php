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

$customer_id = $row['customer_id'];
$username = $row['username'];
$email = $row['email'];
$mobile = $row['mobile'];
$address = $row['address'];
$city = $row['city'];
$state = $row['state'];
$zip = $row['zip'];

$paymentID = $paymentID;
    
$sql_user_data = "INSERT INTO checkout_user_data (customer_id, user_name, user_email, user_phone, user_address, user_city, user_state, user_zip, payment_id) VALUES ('$customer_id', '$username', '$email', '$mobile', '$address', '$city', '$state', '$zip', '$paymentID')";

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

    $sql_cart_data = "INSERT INTO checkout_cart_data (customer_id, product_name, product_size, product_price, product_quantity, subtotal_amount, coupon_code, total_amount, payment_id) VALUES ('$customer_id', '$product_name', '$product_size', '$product_price', '$product_quantity', '$subTotal', '$coupon','$test_Total','$paymentID')";
    if ($conn->query($sql_cart_data) === TRUE) {
        echo "Cart information inserted successfully";
    } else {
        echo "Error: " . $sql_cart_data . "<br>" . $conn->error;
    }  
} 


$sql_join = "SELECT ud.customer_id, ud.user_name, ud.user_email, ud.user_phone, ud.user_address, ud.user_city, ud.user_state, ud.user_zip, ud.payment_id, cd.product_name, cd.product_size, cd.product_price, cd.product_quantity, cd.subtotal_amount, cd.coupon_code, cd.total_amount
FROM checkout_user_data AS ud
JOIN checkout_cart_data AS cd ON ud.payment_id = cd.payment_id AND ud.customer_id = cd.customer_id
ORDER BY ud.customer_id, ud.payment_id DESC"; // Order by customer and payment ID descending

$previous_customer_id = null;
$latest_payment_id = null;
$stmt = null; // Initialize the statement variable outside the loop

$result_join = $conn->query($sql_join);
if ($result_join) {
    while ($row_join = $result_join->fetch_assoc()) {
        $current_payment_id = $row_join['payment_id'];

        // Check if payment ID has changed or if it's the first iteration
        if ($current_payment_id !== $latest_payment_id) {
            if ($stmt) {
                $stmt->execute();
                $stmt->close(); // Close the previous statement
                echo "Total information inserted successfully for previous payment<br>";
            }

            $latest_payment_id = $current_payment_id;

            $sql_total_data = "INSERT INTO checkout_total_data (customer_id, user_name, user_email, user_phone, user_address, user_city, user_state, user_zip, payment_id, product_name, product_size, product_price, product_quantity, subtotal_amount, coupon_code, total_amount, cart_payment_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql_total_data);
            $stmt->bind_param(
                "sssssssssssssssss",
                $row_join['customer_id'],
                $row_join['user_name'],
                $row_join['user_email'],
                $row_join['user_phone'],
                $row_join['user_address'],
                $row_join['user_city'],
                $row_join['user_state'],
                $row_join['user_zip'],
                $row_join['payment_id'],
                $row_join['product_name'],
                $row_join['product_size'],
                $row_join['product_price'],
                $row_join['product_quantity'],
                $row_join['subtotal_amount'],
                $row_join['coupon_code'],
                $row_join['total_amount'],
                $row_join['payment_id']
            );
        }
    }

    // Execute the last insert after the loop ends
    if ($stmt) {
        $stmt->execute();
        $stmt->close(); // Close the last statement
        echo "Total information inserted successfully for the last payment<br>";
    } else {
        echo "Error: " . $stmt;
    }
} else {
    echo "Error: " . $sql_join . "<br>" . $conn->error;
}


?>