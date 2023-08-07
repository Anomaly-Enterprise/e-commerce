<?php

require("include/db_connection.php");

$query = "SELECT name, image, price FROM product_data where price = 1499";
$result = mysqli_query($conn, $query);


$productHTML = '';
while ($row = mysqli_fetch_assoc($result)) {
    $productName = $row['name'];
    $productPrice = $row['price'];


    $imageData = base64_encode($row['image']);

    $productHTML .= '<div class="pro">';
    $productHTML .= '<img src="data:image/jpeg;base64,' . $imageData . '" alt="' . $productName . '">';
    $productHTML .= '<div class="des">';
    $productHTML .= '<span>Raymond</span>';
    $productHTML .= '<h5>' . $productName . '</h5>';
    $productHTML .= '<h4>₹' . $productPrice . '</h4>';
    $productHTML .= '<a href="#"><i class="fal fa-shopping-cart cart"></i></a>';
    $productHTML .= '</div>';
    $productHTML .= '</div>';
}


echo $productHTML;


mysqli_close($conn);
?>
