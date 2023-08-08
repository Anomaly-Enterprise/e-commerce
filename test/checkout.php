<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Checkout Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>
        <form id="checkout-form">
            <label for="name">Name:</label>
            <input type="text" id="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" required>
            
            <label for="address">Shipping Address:</label>
            <textarea id="address" required></textarea>
            
            <h3>Order Summary</h3>
            <div id="order-summary">
                <!-- Order summary items will be dynamically added here -->
            </div>
            
            <button type="submit">Place Order</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
