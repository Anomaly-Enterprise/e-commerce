<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection
    include '../../include/db_connection.php';

    // Get form data
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];

    // Check if an image was uploaded
    if (isset($_FILES["product_image"])) {
        $uploadError = $_FILES["product_image"]["error"];

        if ($uploadError === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES["product_image"]["tmp_name"]);

            // Insert data into the database
            $sql = "INSERT INTO product_data (name, image, price) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssd", $product_name, $imageData, $product_price);

            if ($stmt->execute()) {
                // Success
                // $success_message = "Product added successfully!";
                header("Location:../index.php");
            } else {
                // Error
                $error_message = "Error adding product to the database.";
            }

            $stmt->close();
        } else {
            $error_message = "Image upload error: " . getUploadErrorMessage($uploadError);
        }
    } else {
        $error_message = "Image upload error.";
    }

    // Close the database connection
    $conn->close();
}

// Display success or error messages if set
if (isset($success_message)) {
    echo '<p style="color: green;">' . $success_message . '</p>';
}
if (isset($error_message)) {
    echo '<p style="color: red;">' . $error_message . '</p>';
}

function getUploadErrorMessage($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_INI_SIZE:
            return "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
        case UPLOAD_ERR_FORM_SIZE:
            return "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
        case UPLOAD_ERR_PARTIAL:
            return "The uploaded file was only partially uploaded.";
        case UPLOAD_ERR_NO_FILE:
            return "No file was uploaded.";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Missing a temporary folder.";
        case UPLOAD_ERR_CANT_WRITE:
            return "Failed to write file to disk.";
        case UPLOAD_ERR_EXTENSION:
            return "A PHP extension stopped the file upload.";
        default:
            return "Unknown upload error.";
    }
}
?>
