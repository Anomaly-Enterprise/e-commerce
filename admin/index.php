<?php include 'include_admin/header.php'; ?>
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
                            echo '<td class="product-description">' . $row["description"] . '</td>';
                            echo '<td class="product-image-cell"><img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Product Image" class="product-image"></td>';
                            echo '<td class="product-price">₹' . $row["price"] . '</td>';
                            echo '<td class="product-actions"><a href="update_product.php?id=' . $row["id"] . '">Edit</a></td>';
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
            </main>
            <?php include 'include_admin/footer.php'; ?>