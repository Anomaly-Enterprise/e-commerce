<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        #user-profile {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #user-profile h2 {
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .profile-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }
        .profile-details {
            display: flex;
            justify-content: space-between;
        }
        .profile-details .user-info,
        .profile-details .order-history {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .profile-details h3 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="user-profile">
        <h2>User Profile</h2>
        <div class="profile-info">
            <img src="user_avatar.jpg" alt="User Avatar">
            <div class="user-name">John Doe</div>
        </div>
        <div class="profile-details">
            <div class="user-info">
                <h3>Account Information</h3>
                <p><strong>Email:</strong> user@example.com</p>
                <p><strong>Location:</strong> 123 Main St, City</p>
                <button>Edit Profile</button>
            </div>
            <div class="order-history">
                <h3>Order History</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456</td>
                            <td>Product 1</td>
                            <td>$49.99</td>
                            <td>Delivered</td>
                        </tr>
                        <tr>
                            <td>789012</td>
                            <td>Product 2</td>
                            <td>$29.99</td>
                            <td>Processing</td>
                        </tr>
                        <!-- More order rows... -->
                    </tbody>
                </table>
                <button>View All Orders</button>
            </div>
        </div>
    </div>
</body>
</html>
