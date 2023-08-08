<?php
require_once '../include/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the AJAX request
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Update the address in the database
    $sql = "UPDATE tbl_member SET address = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $address, $email);

    if ($stmt->execute()) {
        echo "Address updated successfully!";
    } else {
        echo "Error updating address: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>
