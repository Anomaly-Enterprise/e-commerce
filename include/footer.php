<?php 
$loggedIn = isset($_SESSION["username"]);

?>
<footer class="section-p1">
        <div class="col">
            <img src="img/logo.png" class="logo" alt="logo">
            <h4>Contact</h4>
            <p><strong>Address:</strong>Lorem ipsum dolor sit adipisicing elit. Laborum.</p>
            <p><strong>Phone:</strong>+01 2222 365/ (+91) 01 2345 6789</p>
            <p><strong>Hours:</strong>10:00 - 18:00, Mon-Sat</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="about.php">About us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="contact.php">Contact us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="about.php">About us</a>
            <?php if (!$loggedIn){ ?>
                <a href="login.php">Sign in</a>
            <?php } ?>
            <a href="cart.php">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track my Order</a>
            <a href="#">Help</a>
        </div>
        <div class="col install">
            <h4>Trusted Payment Options</h4>
            <p>From Government of India</p>
            <div class="row">
                <img src="img/pay/mobile-banking.png" width="70px" height="50px" alt="">
                <img src="img/pay/Bhim-Upi-Logo.png" width="300px" height="50px" alt="">
            </div>
            <p>Secured payment Gateway</p>
            <img src="img/pay/razorpay.png" width="250px" height="60px">
        </div>
    </footer>
    <div class="new-copy" style="display: flex; justify-content: center; align-items: center; text-align: center; background-color: #f2f2f2; padding: 0;">
        <p style="font-size: 14px; color: #888;">&copy; 2023 Anomaly Enterprise PVT. LTD. All rights reserved.</p>
        <p style="font-size: 16px; margin-left: 10px;">Crafted with <span style="color: #e74c3c;">&#9829;</span> by <span style="color: #333; font-weight: bold;">Charmi Kalyani</span></p>
    </div>
    <script src="js/script.js"></script>
    <script src="js/redirect_product.js"></script>
</body>
</html>
