<?php
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
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>