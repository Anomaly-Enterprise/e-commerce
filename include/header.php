<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="blogger/index.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        .cart-remove-btn {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .cart-quantity-input {
            width: 60px;
            text-align: center;
        }
        .cart-apply-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <section id="header">
        <a href="home.php"><img src="img/logo.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li id="lg-bag"><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                <?php
                // Check if the user is logged in
                session_start();
                if (isset($_SESSION["username"])) {
                   
                    echo '<li id="lg-user"><a href="logout.php"><i class="far fa-user"></i></a></li>';
                } else {
                    
                    echo '<li id="lg-user"><a href="login.php"><i class="far fa-user"></i></a></li>';
                }
                ?>
                <!-- <li id="lg-user"><a href="login.php"><i class="far fa-user"></i></a></li> -->
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>

        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>