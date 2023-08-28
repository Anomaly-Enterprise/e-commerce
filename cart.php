<?php
    include 'include/header.php';
?>
<style>
    .popup {
        display: none; /* Change this line to hide the popup by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    .popup-content {
        background-color: white;
        max-width: 600px;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
    }
</style>
<?php
    include 'include/db_connection.php';
    $loggedIn = isset($_SESSION["username"]);
    if($loggedIn){
        if(isset($_COOKIE['email'])){
            $email = mysqli_real_escape_string($conn, $_COOKIE['email']); // Escape user input
            $row = [];
            $query = "SELECT * FROM tbl_member WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
            }
        }else{
            header('location: login.php');
        }
    }
    
?>
    <section id="page-header" class="about-header">
        <h2>LET'S TALK</h2>
        <p>LEAVE A MESSAGE, We Love To Hear From You!</p>
    </section>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Size</td>
                    <td>Quantity</td>
                    <td>SubTotal</td>
                </tr>
            </thead>
            <tbody id="cart-items-body"></tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon Code" id="coupon-code">
                <button class="normal" onclick="applyCoupon()">Apply</button>
            </div>
            
        </div>
        <div id="subtotal">
            <!-- <form action="checkout.php" method="POST"> -->
                <h3>Cart Totals</h3>
                <table>
                    <tr>
                        <td>Cart SubTotal</td>
                        <td id="cart-subtotal">₹0.00</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td id="cart-shipping-fee">Free</td>
                    </tr>
                    
                    <tr id="coupon-details-row" style="display: none;">
                        <td>Applied Coupon</td>
                        <td id="applied-coupon"></td>
                    </tr>
                    <tr id="coupon-discount-row" style="display: none;">
                        <td>Coupon Discount</td>
                        <td id="coupon-discount">₹ 0.00</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td id="total">₹0.00</td>
                    </tr>
                </table>
                <input type="hidden" id="cart-data" name="cart_data_for_php" value="">
                <?php if($loggedIn){?>
                <button type="submit" onclick="openCheckoutPopup()" id="checkout-btn" class="normal">Proceed To CheckOut</button>
                <?php }else{ ?>
                    <script>
                        alert("Please Login First");
                        window.location.href = "login.php";
                    </script>
                <?php } ?>
                <!-- onclick="openCheckoutPopup()" -->
            <!-- </form> -->
        </div>
    </section>
    
    <!-- <button id="openPopupBtn">Open Popup</button> -->
    <div id="checkoutPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeCkeckoutPopup()">&times;</span>
                <?php include 'checkOutPopup.php'; ?>
        </div>
    </div>
    
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


        var razorpayUserName = "<?php echo $row['username']; ?>";
        var razorpayUserEmail = "<?php echo $row['email']; ?>";
        var razorpayUserAddress = "<?php echo $row['address']; ?>";
        var razorpayUserContact = "<?php echo $row['mobile']; ?>";

    </script>

    <script src="js/cart.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="js/razorpay.js"></script>
    <?php include 'include/footer.php'; ?>