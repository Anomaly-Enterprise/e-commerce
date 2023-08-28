<?php
// Start the session
session_start();

// Clear all session variables
$_SESSION = array();

// Expire the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Destroy the session
session_destroy();

// Expire user and email cookies
setcookie("user", "", time() - 3600, "/");
setcookie("email", "", time() - 3600, "/");

// Redirect to the index page
$url = "./home.php";
header("Location: $url");
exit();
?>
