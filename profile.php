<?php include 'include/header.php'; ?>
<?php include 'include/header_for_popup.php'; ?>

<div id="user-profile">
    <!-- <h2>User Profile</h2> -->
    <div class="profile-details">
        <div class="user-info">
            <?php if ($loggedIn) { 
                $username = $_SESSION["username"];
                $email = $_SESSION["username"];
                $query = "SELECT * FROM tbl_member WHERE username = ? or email = ?";
                $statement = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($statement, "ss", $username, $email);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                $row = mysqli_fetch_assoc($result);
                ?>
            <h3>Personal Information</h3>
            <p><strong>Username:</strong> <?php echo $row['username'];?></p>
            <p><strong>Email:</strong> <?php echo $row['email'];?></p>
            <p><strong>Mobile:</strong> <?php echo $row['mobile'];?></p>
            <p><strong>Address:</strong> <?php echo $row['address'];?></p>
            <p><strong>City:</strong> <?php echo $row['city'];?></p>
            <p><strong>State:</strong> <?php echo $row['state'];?></p>
            <p><strong>Zip:</strong> <?php echo $row['zip'];?></p>
            <?php } ?>
            <button class="edit-profile-button" onclick="showPopup()">Edit Profile</button>
        </div>
        <div class="order-history">
            <h3>Order History</h3>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Product Price (INR)</th>
                        <th>Sub Total</th>
                        <th>Discount Coupon</th>
                        <th>Total Price(INR)</th>
                        <th>Payment ID</th>
                        <!-- <th>Total Amount Paid</th> -->
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($loggedIn) {
                        $orderQuery = "SELECT DISTINCT payment_id, order_id, product_name, product_quantity, product_price, subtotal_amount, coupon_code, total_amount, payment_id FROM checkout_total_data WHERE user_name = ?";
                        $orderStatement = mysqli_prepare($conn, $orderQuery);
                        mysqli_stmt_bind_param($orderStatement, "s", $_SESSION["username"]);
                        mysqli_stmt_execute($orderStatement);
                        $orderResult = mysqli_stmt_get_result($orderStatement);

                        $printedPaymentIds = array();

                        while ($orderRow = mysqli_fetch_assoc($orderResult)) {
                            $paymentId = $orderRow['payment_id'];
                            if (!in_array($paymentId, $printedPaymentIds)) {
                                echo "<tr>";
                                echo "<td>" . $orderRow['order_id'] . "</td>";
                                echo "<td>" . $orderRow['product_name'] . "</td>";
                                echo "<td>" . $orderRow['product_quantity'] . "</td>";
                                echo "<td>" . $orderRow['product_price'] . "</td>";
                                echo "<td>" . $orderRow['subtotal_amount'] . "</td>";
                                echo "<td>" . $orderRow['coupon_code'] . "</td>";
                                echo "<td>" . $orderRow['total_amount'] . "</td>";
                                echo "<td>" . $paymentId . "</td>";
                                echo "</tr>";
                                
                                // Add the payment_id to the printedPaymentIds array
                                $printedPaymentIds[] = $paymentId;
                            }
                        }
                    }
                ?>
                </tbody>
            </table>
            <!-- <button>View All Orders</button> -->
        </div>
    </div>
</div>
<div id="edit-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <!-- <span class="close-btn" onclick="closePopup()">&times;</span> -->
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <?php include 'update_profile_ui.php'; ?>
    </div>
</div>
<div id="success-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closeSuccessPopup()">&times;</span>
        <p>Profile Updated Successfully</p>
    </div>
</div>
<div id="error-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closeErrorPopup()">&times;</span>
        <p>Database Error Occurred</p>
    </div>
</div>

<script>
    function showErrorPopup() {
        var errorPopup = document.getElementById('error-popup');
        errorPopup.style.display = 'block';
    }

    // Function to close the error popup
    function closeErrorPopup() {
        var errorPopup = document.getElementById('error-popup');
        errorPopup.style.display = 'none';
    }

    // Check if the error query parameter is present and show the popup
    var urlParams = new URLSearchParams(window.location.search);
    var errorParam = urlParams.get('error');
    if (errorParam === 'database_error') {
        showErrorPopup();
    }
    
    function showSuccessPopup() {
        var successPopup = document.getElementById('success-popup');
        successPopup.style.display = 'block';
    }

    // Function to close the success popup
    function closeSuccessPopup() {
        var successPopup = document.getElementById('success-popup');
        successPopup.style.display = 'none';
    }

    // Check if the success query parameter is present and show the popup
    var urlParams = new URLSearchParams(window.location.search);
    var successParam = urlParams.get('success');
    if (successParam === 'profile_updated') {
        showSuccessPopup();
    }
    // Function to show the edit profile popup
    function showPopup() {
        var popup = document.getElementById('edit-popup');
        popup.style.display = 'block';
    }

    // Function to close the edit profile popup
    function closePopup() {
        var popup = document.getElementById('edit-popup');
        popup.style.display = 'none';
    }

    // Close the popup if the user clicks outside the popup
    window.addEventListener('click', function (event) {
        var popup = document.getElementById('edit-popup');
        if (event.target === popup) {
            closePopup();
        }
    });
</script>

<?php include 'include/footer.php'; ?>