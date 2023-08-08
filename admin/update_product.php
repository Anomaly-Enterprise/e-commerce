<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h3>Update Product</h3>
    <form action="data/update_product_data.php" method="post">
        <label for="product_id">Product ID:</label>
        <input type="number" id="product_id" name="product_id" required>
        
        <label for="product_name">New Product Name:</label>
        <input type="text" id="product_name" name="product_name">
        
        <label for="product_image">New Product Image URL:</label>
        <input type="text" id="product_image" name="product_image">
        
        <label for="product_price">New Product Price:</label>
        <input type="number" id="product_price" name="product_price" step="0.01">
        
        <button type="submit">Update Product</button>
    </form>
</body>
</html>

    
