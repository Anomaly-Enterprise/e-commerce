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

                <!-- Add more sections for different dashboard components as needed -->
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
</script>
    <!-- Include any scripts or additional elements here -->
</body>
</html>
