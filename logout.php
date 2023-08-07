<?php
// clear all the session variables and redirect to index
session_start();
session_unset();
setcookie("user", "", time() - 3600);
setcookie("email", "", time() - 3600);
session_write_close();
$url = "./index.php";
header("Location: $url");
