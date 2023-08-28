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
                <form action="checkouttest.php" id="checkout-form" method="POST">
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
                    <input type="hidden" name="cust_id" value="<?php echo $row['customer_id']; ?>">
                    <textarea id="cart-data-display" style="display: none;"></textarea>
                    <div id="updateAddressPopup" class="popup" style="display: none;">
                        <div class="popup-content">
                            <span class="close-btn" onclick="closeUpdateAddressPopup()">&times;</span>
                                <?php include 'data/change_address.php'; ?>
                                <div class="updateAddressReturnMessage"></div>
                        </div>
                    </div>
                    <!-- <span id="tran_status" style="display: none;">Your Transaction ID : <span style="display: none;" id="trans_detail"></span></span> -->
                    <input type="button" value="Continue to checkout" onclick="initiateRazorpayPayment()" class="btn">
                    <input type="button" value="Update Address" onclick="openUpdateAddress()" class="btn">
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const cartData = JSON.parse(localStorage.getItem("cartItems")) || {};
        document.getElementById('cart-data-for-php').value = JSON.stringify(cartData);

        // Display the cart_data in the textarea for debugging
        document.getElementById('cart-data-display').textContent = JSON.stringify(cartData);
        
        // Initialize and populate $cartData for PHP use
        const cartDataForPHP = JSON.stringify(cartData);

        // Assign the value to a hidden input field for PHP to access
        document.getElementById('cart-data-for-php').value = cartDataForPHP;
    });

    var popupAddress = document.getElementById('updateAddressPopup');
    function openUpdateAddress() {
        updateAddress();
        popupAddress.style.display = 'flex';
        
    }
    function closeUpdateAddressPopup() {
        popupAddress.style.display = 'none';
    }
    window.addEventListener('click', function(event) {
        if (event.target === popupAddress) {
            closeUpdateAddressPopup();
        }
    });

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

    function updateAddress(){
        var username = document.getElementById("fname").value;
        var useremail = document.getElementById("email").value;
        var usercontact = document.getElementById("phone").value;
        var useraddress = document.getElementById("adr").value;
        var usercity = document.getElementById("city").value;
        var userstate = document.getElementById("state").value;
        var userpincode = document.getElementById("zip").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "data/change_address.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server, if needed
                var response = xhr.responseText;
                var returnUpdateAddress = document.querySelector('.updateAddressReturnMessage');
                returnUpdateAddress.innerHTML = response;
            }
        };

        // Prepare the data to be sent
        var params = "username=" + encodeURIComponent(username) +
                    "&useremail=" + encodeURIComponent(useremail) +
                    "&usercontact=" + encodeURIComponent(usercontact) +
                    "&useraddress=" + encodeURIComponent(useraddress) +
                    "&usercity=" + encodeURIComponent(usercity) +
                    "&userstate=" + encodeURIComponent(userstate) +
                    "&userpincode=" + encodeURIComponent(userpincode);

        // Send the request
        xhr.send(params);
    }
</script>

    <script src="js/cart.js"></script>
    <script src="js/razorpay.js"></script>
</body>
</html>
