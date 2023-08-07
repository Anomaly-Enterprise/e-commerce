<?php
// get_product_details.php

require_once 'include/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = isset($_POST["name"]) ? $_POST["name"] : "";
    $productPrice = isset($_POST["price"]) ? $_POST["price"] : "";

    $sql = "SELECT image FROM product_data WHERE name = ? AND price = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $productName, $productPrice);
    $stmt->execute();
    $stmt->bind_result($imageData);
    $stmt->fetch();
    $stmt->close();

    if ($imageData) {
        $response = array(
            'imageData' => base64_encode($imageData),
            'name' => $productName,
            'price' => $productPrice
        );
    } else {
        $response = array('imageData' => null);
    }

    echo json_encode($response);
}
?>
