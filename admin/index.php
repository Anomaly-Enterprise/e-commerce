<?php
// admin/index.php

// Check if admin is logged in using the admin_login cookie
if (!isset($_COOKIE['admin_login']) || $_COOKIE['admin_login'] !== 'Admin') {
    // Admin is not logged in, redirect to login page
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_dashboard.css">
    <!-- Include your CSS links here -->
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <h3>Admin Dashboard</h3>
            </div>

            <ul class="list-unstyled components">
                <li><a href="javascript:void(0);" onclick="showSection('dashboard')">Dashboard</a></li>
                <li><a href="javascript:void(0);" onclick="showSection('users')">Users</a></li>
                <li><a href="javascript:void(0);" onclick="showSection('transactions')">Transactions</a></li>
                <li><a href="javascript:void(0);" onclick="showSection('products')">Show all Products</a></li>
                <li><a href="javascript:void(0);" onclick="showSection('add_products')">Add Products</a></li>
                <li><a href="javascript:void(0);" onclick="showSection('settings')">Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>

        <div id="content" class="content">
            <header class="header">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-bars"></i>
                </button>
                <h2>Admin Dashboard</h2>
            </header>

            <main class="main-content">
                <section id="dashboard" class="dashboard-section" style="display: block;">
                    <h1>Welcome, <?php echo $_COOKIE['admin_login']; ?></h1>
                </section>

                <section id="transactions" class="dashboard-section" style="display: none;">
                    <?php include 'transaction_details.php'; ?>
                </section>

                <section id="users" class="dashboard-section" style="display: none;">
                    <?php include 'member_log_details.php'; ?>
                </section>
                <section id="settings" class="dashboard-section" style="display: none;">
                    <!-- Settings content goes here -->
                </section>
                <!-- <main class="main-content"> -->
                    <section id="products" class="dashboard-section" style="display: none;">
                        <div class="action-buttons">
                            <button onclick="showAddProducts()">Add Product</button>
                            <button onclick="exportProducts()">Export</button>
                            <button onclick="importProducts()">Import</button>
                        </div>
                        <div id="addProductPopup" class="popup">
                            <div class="popup-content">
                                <span class="close" onclick="closePopup()">&times;</span>
                                <?php include 'add_product.php'; ?>
                            </div>
                        </div>
                        <?php
                        include '../include/db_connection.php';

                        $sql = "SELECT * FROM product_data";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<div class="table-container">';
                            echo '<table class="table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Product Name</th>';
                            echo '<th>Product Description</th>';
                            echo '<th>Product Image</th>';
                            echo '<th>Product Price</th>';
                            echo '<th>Actions</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td class="product-name">' . $row["name"] . '</td>';
                                echo '<td class="product-image-cell"><img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Product Image" class="product-image"></td>';
                                echo '<td class="product-price">₹' . $row["price"] . '</td>';
                                echo '<td class="product-actions"><a href="edit_product.php?id=' . $row["id"] . '">Edit</a></td>';
                                echo '</tr>';
                            }
                            
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        } else {
                            echo '<p>No products found.</p>';
                        }

                        $conn->close();
                        ?>
                    </section>
                <!-- </main> -->
                <section id="add_products" class="dashboard-section" style="display: none;">
                    <?php include 'add_product.php'; ?>
                </section>
                <section id="update_products" class="dashboard-section" style="display: none;">
                    <?php include 'update_product.php';?>
                </section>
                <section id="delete_products" class="dashboard-section" style="display: none;">
                    <?php include 'delete_product.php';?>
                </section>
            </main>
            <footer class="footer">
                &copy; <?php echo date('Y'); ?> Your Company. All rights reserved.
            </footer>
        </div>
    </div>
    
<script>
function showSection(sectionId) {
    var sections = document.querySelectorAll('.dashboard-section');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });
    
    var selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}
function showAddProducts() {
    var addProductPopup = document.getElementById('addProductPopup');
    addProductPopup.style.display = 'block';
}

function closePopup() {
    var addProductPopup = document.getElementById('addProductPopup');
    addProductPopup.style.display = 'none';
}

// function exportProducts() {
//     // Implement logic to export products
// }

// function importProducts() {
//     // Implement logic to import products
// }
</script>
    <!-- Include any scripts or additional elements here -->
</body>
</html>
