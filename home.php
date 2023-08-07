<?php
    include 'include/header.php';
?>
    <section id="hero">
        <h4>Trade-In-Offer</h4>
        <h2>Super Value Deals</h2>
        <h1>On All Products</h1>
        <p>Save more money with Coupons upto 70% Off!</p>
        <button>Shop Now</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="feature">
            <h6>Free Shipping</h6>
        </div>

        <div class="fe-box">
            <img src="img/features/f2.png" alt="feature">
            <h6>Online Order</h6>
        </div>

        <div class="fe-box">
            <img src="img/features/f3.png" alt="feature">
            <h6>Save Money</h6>
        </div>

        <div class="fe-box">
            <img src="img/features/f4.png" alt="feature">
            <h6>Promotions</h6>
        </div>

        <div class="fe-box">
            <img src="img/features/f5.png" alt="feature">
            <h6>Happy Sell</h6>
        </div>

        <div class="fe-box">
            <img src="img/features/f6.png" alt="feature">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
        <?php
        require_once 'include/db_connection.php';

        $sql = "SELECT name, image, price FROM product_data where price IN (1699, 1799)";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $imageData = $row['image'];
                $imageBase64 = base64_encode($imageData);
                $imageSrc = "data:image/jpeg;base64," . $imageBase64;
        ?>
                <button class="pro" data-name="<?php echo $name; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $imageBase64; ?>" onclick="redirectToSingleProduct(this)">
                    <img src="<?php echo $imageSrc; ?>">
                    <div class="des">
                        <span>Raymond</span>
                        <h5><?php echo $name; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>₹<?php echo $price; ?></h4>
                        <!-- <a href="#"><i class="fal fa-shopping-cart cart"></i></a> -->
                    </div>
                </button>
        <?php
            }
        } else {
            echo "No products found.";
        }

        
        ?>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Repair Service</h4>
        <h2>Upto <span>70% Off</span> - All T-Shirts and Accessories</h2>
        <button class="normal">Explore More</button>

    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
        <?php
        require_once 'include/db_connection.php';
        $sql = "SELECT name, image, price FROM product_data where price IN (1499, 1599)";
            $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $imageData = $row['image'];
                $imageBase64 = base64_encode($imageData);
                $imageSrc = "data:image/jpeg;base64," . $imageBase64;
        ?>
                <button class="pro" data-name="<?php echo $name; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $imageBase64; ?>" onclick="redirectToSingleProduct(this)">
                    <img src="<?php echo $imageSrc; ?>">
                    <div class="des">
                        <span>Raymond</span>
                        <h5><?php echo $name; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>₹<?php echo $price; ?></h4>
                        <!-- <a href="#"><i class="fal fa-shopping-cart cart"></i></a> -->
                    </div>
                </button>
        <?php
            }
        } else {
            echo "No products found.";
        }

        $conn->close();
        ?>
        </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Crazy Deals</h4>
            <h2>Buy 1 get 1 free</h2>
            <span>The best classic dress is on Sale at Cara</span>
            <button class="white">Learn More</button>
        </div>

        <div class="banner-box banner-box2">
            <h4>Spring/Summer</h4>
            <h2>Upcoming Season</h2>
            <span>The best classic dress is on Sale at Cara</span>
            <button class="white">Learn More</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </div>

        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring/Summer 2022</h3>
        </div>

        <div class="banner-box banner-box3">
            <h2>T-Shirts</h2>
            <h3>New Trendy Prints</h3>
        </div>

    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up for NewsLetter</h4>
            <p>Get E-mail updates about our latest shops and <span>special offers.</span></p>
        </div>
        <!-- <div style="text-align: center" class="sender-form-field form" data-sender-form-id="lksgjsshbq0m7anshum"></div> -->
    </section>
    
    <script>
    (function (s, e, n, d, er) {
        s['Sender'] = er;
        s[er] = s[er] || function () {
        (s[er].q = s[er].q || []).push(arguments)
        }, s[er].l = 1 * new Date();
        var a = e.createElement(n),
            m = e.getElementsByTagName(n)[0];
        a.async = 1;
        a.src = d;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://cdn.sender.net/accounts_resources/universal.js', 'sender');
    sender('f2ed35db240844')
    </script>
    <?php include 'include/footer.php'; ?>