<?php
include 'include/db_connection.php';
$email = mysqli_real_escape_string($conn, $_COOKIE['email']); // Escape user input
$row = [];
$query = "SELECT * FROM tbl_member WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
    <h2 style="align-items:center; justify-content: center;">Billing Address</h2>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form action="checkout.php" id="checkout-form" method="POST">
                    <div class="row">
                        <div class="col-50"><br>
                            <!-- <h3>Billing Address</h3><br> -->
                            <label for="fname"><i class="fa fa-user" aria-hidden="true"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" value="<?php echo $row['username']; ?>" placeholder="Full Name">
                            <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
                            <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" placeholder="example@example.com">
                            <label for="phone"><i class="fa fa fa-phone" aria-hidden="true"></i> Phone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo $row['mobile']; ?>" placeholder="Mobile Number">
                            <label for="adr"><i class="fa fa-address-card-o" aria-hidden="true"></i> Address</label>
                            <input type="text" id="adr" name="address" value="<?php echo $row['address']; ?>" placeholder="Address">
                            <label for="city"><i class="fa fa-institution" aria-hidden="true"></i>City</label>
                            <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>" placeholder="City">
                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" value="<?php echo $row['state']; ?>" placeholder="State">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" value="<?php echo $row['zip']; ?>" placeholder="Zip">
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                    </label>
                    <input type="hidden" id="cart-data-for-php" name="cart_data_for_php" value="">
                    <textarea id="cart-data-display" style="display: none;"></textarea>
                    <span id="tran_status" style="display: none;">Your Transaction ID : <span style="display: none;" id="trans_detail"></span></span>
                    <input type="button" value="Continue to checkout" onclick="initiateRazorpayPayment()" class="btn">
                </form>
            </div>
        </div>
    </div>
    <div id="paymentSuccessPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1>Payment Successful!</h1>
        <p>Payment ID: <span id="paymentID"></span></p><br>
        <button onclick="closePopup()">Close</button>
    </div>
    <script>
        var popup = document.getElementById('checkoutPopup');
        function openCheckoutPopup() {
            popup.style.display = 'flex';
        }
        function closeCkeckoutPopup() {
            popup.style.display = 'none';
        }
        window.addEventListener('click', function(event) {
            if (event.target === popup) {
                closeCkeckoutPopup();
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cartData = JSON.parse(localStorage.getItem("cartItems")) || {};
            document.getElementById('cart-data').value = JSON.stringify(cartData);

            // Display the cart_data in the textarea for debugging
            document.getElementById('cart-data-display').textContent = JSON.stringify(cartData);
            
            // Initialize and populate $cartData for PHP use
            const cartDataForPHP = JSON.stringify(cartData);

            // Assign the value to a hidden input field for PHP to access
            document.getElementById('cart-data-for-php').value = cartDataForPHP;
        });
    </script>

    <script src="js/cart.js"></script>
    <script src="js/razorpay.js"></script>
</body>
</html>
