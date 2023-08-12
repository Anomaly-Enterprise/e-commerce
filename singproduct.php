<?php
include 'include/header.php';
require_once 'include/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = isset($_POST["name"]) ? $_POST["name"] : "";
    $productPrice = isset($_POST["price"]) ? $_POST["price"] : "";
    $productDescription = isset($_POST["description"])? $_POST["description"] : "";

    $sql = "SELECT image, description FROM product_data WHERE name = ? AND price = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $productName, $productPrice);
    $stmt->execute();
    $stmt->bind_result($imageData, $productDescription);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();
    ?>
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .close-btn:hover {
            color: red;
        }
    </style>
    <section id="prodedetails" class="section-p1">
        <div class="single-pro-image">
            <!-- Display the main product image -->
            <?php
            if ($imageData) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Product Image" width="100%" id="MainImg">';

                // Fetch other products with the same price
                $sql = "SELECT name, price, image FROM product_data WHERE price = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $productPrice);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display small images of products with the same price
                echo '<div class="small-img-grp">';
                while ($row = $result->fetch_assoc()) {
                    $smallImageData = $row['image'];
                    echo '<div class="small-img-col">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($smallImageData) . '" width="100%" class="small-img" alt="image">';
                    echo '</div>';
                }
                echo '</div>';

                // Close the statement
                $stmt->close();
            } else {
                echo "<p>No product details found.</p>";
            }
            ?>
        </div>
        <div class="single-pro-details">
            <h6>Home / T-Shirt</h6>
            <?php
            echo "<h2 id='pname'>$productName</h2>";
            echo "Price: ₹<p id='price'>$productPrice</p>";


?>
        <select id="size">
            <option selected disabled>Select Size</option>
            <option>XL</option>
            <option>XXL</option>
            <option>Small</option>
            <option>Large</option>
        </select>
        <input type="number" value="1">

        <button class="normal add-to-cart-btn" onclick="addToCart()">Add to Cart</button>
        <h4>Product Details</h4>
        <span><?php echo $productDescription; ?></span>


<?php
    } else {
    echo "<p>No product details found.</p>";
}
?>     

    </div>
</section>

<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Product Designs</p>
    <div class="pro-container">
        <?php include 'fetch_product.php'; ?>
    </div>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up for NewsLetter</h4>
        <p>Get E-mail updates about our latest shops and <span>special offers.</span></p>
    </div>

    <div class="form">
        <input type="text" placeholder="your email address">
        <button class="normal">Sign up</button>
    </div>
</section>
<div id="customPopup" class="popup">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <h4>Product added to the Cart</h4>
        <button name="red-cart" onclick="redirect()">Proceed to The Cart</button>
        <!-- You can customize the content of the popup here if needed -->
    </div>
</div>


<script src="js/script.js"></script>
<script src="js/single_product.js"></script>
<?php include 'include/footer.php'; ?>