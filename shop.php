<?php include 'include/header.php'; ?>

    <section id="page-header">
        <h2>#stayhome</h2>
        <p>Save more money with Coupons upto 70% Off!</p>
    </section>


    <section id="product1" class="section-p1">
        <div class="pro-container">
        <?php
        require_once 'include/db_connection.php';

        $sql = "SELECT name, image, price FROM product_data";
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
                    <img src="<?php echo $imageSrc; ?>" onclick="redirectToSingleProductFromImage(this)">
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

        // $conn->close();
        ?>
        </div>
    </section>
    <script>
        function redirectToSingleProduct(element) {
            var productName = element.dataset.name;
            var productPrice = element.dataset.price;
            var productImage = element.dataset.image;

            // Create a form dynamically
            var form = document.createElement("form");
            form.method = "post";
            form.action = "singproduct.php";

            // Add hidden fields for the data
            var nameInput = document.createElement("input");
            nameInput.type = "hidden";
            nameInput.name = "name";
            nameInput.value = productName;
            form.appendChild(nameInput);

            var priceInput = document.createElement("input");
            priceInput.type = "hidden";
            priceInput.name = "price";
            priceInput.value = productPrice;
            form.appendChild(priceInput);

            var imageInput = document.createElement("input");
            imageInput.type = "hidden";
            imageInput.name = "image";
            imageInput.value = productImage;
            form.appendChild(imageInput);

            // Add the form to the document and submit it
            document.body.appendChild(form);
            form.submit();
        }

        function redirectToSingleProductFromImage(imageElement) {
            var buttonParent = imageElement.parentElement;
            var productName = buttonParent.dataset.name;
            var productPrice = buttonParent.dataset.price;
            var productImage = buttonParent.dataset.image;

            // Create a form dynamically
            var form = document.createElement("form");
            form.method = "post";
            form.action = "singproduct.php";

            // Add hidden fields for the data
            var nameInput = document.createElement("input");
            nameInput.type = "hidden";
            nameInput.name = "name";
            nameInput.value = productName;
            form.appendChild(nameInput);

            var priceInput = document.createElement("input");
            priceInput.type = "hidden";
            priceInput.name = "price";
            priceInput.value = productPrice;
            form.appendChild(priceInput);

            var imageInput = document.createElement("input");
            imageInput.type = "hidden";
            imageInput.name = "image";
            imageInput.value = productImage;
            form.appendChild(imageInput);

            // Add the form to the document and submit it
            document.body.appendChild(form);
            form.submit();
        }
    </script>

<?php include 'include/footer.php'; ?>