<?php
include '../../include/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $new_product_name = $_POST["product_name"];
    $new_product_description = $_POST['product_description'];
    $new_product_price = $_POST["product_price"];

    // Check if a new image is uploaded
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["name"]) {
        $new_image = file_get_contents($_FILES["product_image"]["tmp_name"]);
        $image_type = $_FILES["product_image"]["type"];

        // Update product data including the image
        $sql_update = "UPDATE product_data SET name = ?, image = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("sbdsi", $new_product_name, $new_image, $new_product_price, $new_product_description, $product_id);
        $stmt->send_long_data(1, $new_image); // Send the BLOB data
        $stmt->execute();
        $stmt->close();

        header('Location: ../index.php');
    } else {
        // If no new image is uploaded, update without changing the image
        $sql_update = "UPDATE product_data SET name = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("sdsi", $new_product_name, $new_product_price, $new_product_description, $product_id);
        $stmt->execute();
        $stmt->close();

        header('Location: ../index.php');
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
