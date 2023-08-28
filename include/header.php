<?php 
session_start();
include 'db_connection.php'; 

$loggedIn = isset($_SESSION["username"]);

$currentPage = basename($_SERVER['PHP_SELF']);

if ($loggedIn) {
    $username = $_SESSION["username"];
    $countQuery = "SELECT count FROM tbl_member WHERE username = ?";
    $countStatement = mysqli_prepare($conn, $countQuery);
    mysqli_stmt_bind_param($countStatement, "s", $username);
    mysqli_stmt_execute($countStatement);
    $countResult = mysqli_stmt_get_result($countStatement);
    $countRow = mysqli_fetch_assoc($countResult);
    $count = $countRow["count"];
    $menuItems = [
        ["text" => "Home", "link" => "home.php"],
        ["text" => "Shop", "link" => "shop.php"],
        ["text" => "Blog", "link" => "blog.php"],
        ["text" => "About", "link" => "about.php"],
        ["text" => "Contact", "link" => "contact.php"],
        ["text" => "Cart" , "link" =>"cart.php"],
        // ["text" => "Sig In", "link" => "login.php"],
        ["text" => "Profile", "link" => "profile.php"],
        ["text" => "Sign Out", "link" => "logout.php"],
    ];
}else{
    $menuItems = [
        ["text" => "Home", "link" => "home.php"],
        ["text" => "Shop", "link" => "shop.php"],
        ["text" => "Blog", "link" => "blog.php"],
        ["text" => "About", "link" => "about.php"],
        ["text" => "Contact", "link" => "contact.php"],
        ["text" => "Cart" , "link" =>"cart.php"],
        ["text" => "Sign In", "link" => "login.php"]
    ];
}


// Define the menu items
$profileItems = [
    ["text" => "Profile", "link" => "profile.php"],
    ["text" => "Logout", "link" => "logout.php"]
];
?>
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
                .dropdown {
                    position: absolute;
                }
                .dropdown .dropdown-menu {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    background-color: #fff;
                    border: 1px solid #ccc; 
                    width: 116px;
                    height: 50px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .dropdown:hover .dropdown-menu {
                    display: block;
                }
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
                        
                        <?php if ($loggedIn) : ?>
                            <?php foreach ($menuItems as $item) : ?>  
                                <?php if($item['text'] === "Cart"){ ?>
                                        <li id="sm-bag"><a <?php  if ($currentPage === $item['link']) echo 'class="active"'; ?> href="<?php echo $item["link"] ?>"><i class="far fa-shopping-bag"></i> <?php echo $username; ?>'s Cart</a></li>
                                <?php } elseif($item['text'] === "Profile") { ?>
                                        <li><a <?php if ($currentPage === $item['link']) echo 'class="active"'; ?> href="<?php echo $item['link']; ?>" class="user-icon"><i class="far fa-user"></i>  <?php echo $item['text']; ?></a></li>
                                <?php }else{ ?>
                                        <li><a <?php if ($currentPage === $item['link']) echo 'class="active"'; ?> href="<?php echo $item['link']; ?>"><?php echo $item['text']; ?></a></li>
                                <?php } ?>
                             <?php endforeach; ?>
                        <?php else : ?>
                            <ul id="navbar">
                                <?php foreach ($menuItems as $item) : ?>
                                    <li><a <?php if ($currentPage === $item['link']) echo 'class="active"'; ?> href="<?php echo $item['link']; ?>"><?php echo $item['text']; ?></a></li>
                                <?php endforeach; ?>
                                    
                            </ul>
                        <?php endif; ?>
                    
                        <a href="#" id="close"><i class="far fa-times"></i></a>
                    </ul>
                </div>
        
                <div id="mobile">
                    <i id="bar" class="fas fa-outdent"></i>
                </div>
            </section>