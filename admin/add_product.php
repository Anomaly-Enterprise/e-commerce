<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <title>Add New Product</title>
</head>
<body>
<!-- <h3>Add New Product</h3> -->
    <div class="section">
        <h3>Add New Product</h3>
        <form action="data/add_product_data.php" method="post" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" accept=".jpg, .jpeg, .png" required>

            <label for="product_price">Product Price:</label>
            <input type="number" id="product_price" name="product_price" step="0.01" required>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
    