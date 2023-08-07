<?php
    include 'include/header.php';
    include 'include/db_connection.php';
    $conn = mysqli_connect("localhost","root","","ecomm");
    $email = $_COOKIE['email'];
    $row = "";
    $query = "SELECT * FROM tbl_member WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
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
            <div>
            <?php
                $uname = "Hi";
                $email = "";
            ?>
            <br><br>
                User Name : <?php echo $row['username']; ?><br><br>
                Email : <?php echo $row['email']; ?> <br><br>
                Phone : <?php echo $row['mobile'];?><br><br>
                Address : <?php echo $row['address']; ?> <br><br>
            </div>
        </div>
        <?php

            // echo $row['username']." ".$row['email'];

        ?>
        <div id="subtotal">
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
            <button id="checkout-btn" class="normal" onclick="initiateRazorpayPayment()">Proceed To CheckOut</button>

        </div>
    </section>
    <div id="paymentSuccessPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1>Payment Successful!</h1>
        <p>Payment ID: <span id="paymentID"></span></p><br>
        <button onclick="closePopup()">Close</button>
    </div>
    
    <script>
        var razorpayUserName = "<?php echo $row['username']; ?>";
        var razorpayUserEmail = "<?php echo $row['email']; ?>";
        var razorpayUserAddress = "<?php echo $row['address']; ?>";
        var razorpayUserContact = "<?php echo $row['mobile']; ?>";
    </script>
    <script src="js/cart.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="js/razorpay.js"></script>
    
    <?php include 'include/footer.php'; ?>