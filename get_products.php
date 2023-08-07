<?php

require_once 'include/db_connection.php';


$sql = "SELECT * FROM product_data";
$result = $conn->query($sql);


$products = array();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');


echo json_encode($products);
?>
