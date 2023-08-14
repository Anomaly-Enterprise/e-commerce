<?php include 'include_admin/header.php'; ?>
<div id="content" class="content">
    <main class="main-content">
        <h3>Update Product</h3>
        <?php
        include '../include/db_connection.php';

        // Get the product ID from the URL
        $product_id = $_GET['id'];

        // Retrieve the existing product data from the database
        $sql = "SELECT * FROM product_data WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            echo '<p>Product not found.</p>';
        } else {
            echo '<form action="data/update_product_data.php" method="post" enctype="multipart/form-data">';
            echo '<label for="product_id">Product ID:</label>';
            echo '<input type="number" id="product_id" name="product_id" value="' . $product_id . '" readonly>';
            
            echo '<label for="product_name">New Product Name:</label>';
            echo '<input type="text" id="product_name" name="product_name" value="' . $row["name"] . '">';

            echo '<label for="product_description">New Product Description:</label>';
            echo '<textarea id="product_description" name="product_description">' . $row["description"] . '</textarea>';

            echo '<p>Current Image:</p>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Product Image" class="product-image">';

            echo '<label for="product_image">New Product Image:</label>';
            echo '<input type="file" id="product_image" name="product_image" accept="image/*">';
            
            echo '<label for="product_price">New Product Price:</label>';
            echo '<input type="number" id="product_price" name="product_price" step="0.01" value="' . $row["price"] . '">';
            
            echo '<button type="submit">Update Product</button>';
            echo '</form>';
        }

        $stmt->close();
        $conn->close();
        ?>
    </main>
</div>
<?php include 'include_admin/footer.php'; ?>
