<?php
// update_profile.php
include 'include/db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated profile information from the form
    $newUsername = $_POST["new-username"];
    $newEmail = $_POST["new-email"];
    $newMobile = $_POST["new-mobile"];
    $newAddress = $_POST["new-address"];
    $newCity = $_POST["new-city"];
    $newState = $_POST["new-state"];
    $newZip = $_POST["new-zip"];
    $newPassword = $_POST["new-password"];
    $confirmPassword = $_POST["confirm-password"];

    // Retrieve old username from hidden form field
    $oldUsername = $_POST["old-username"];

    // Validate inputs and check if the new password matches confirm password
    if ($newPassword !== $confirmPassword) {
        // Handle password mismatch error
        header("Location: user_profile.php?error=password_mismatch");
        exit;
    }

    // Create a prepared statement to update the user's profile information
    $query = "UPDATE tbl_member
              SET username=?, email=?, mobile=?, address=?, city=?, state=?, zip=?, password=?
              WHERE username=?";
    $statement = mysqli_prepare($conn, $query);

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param(
        $statement,
        "sssssssss",
        $newUsername,
        $newEmail,
        $newMobile,
        $newAddress,
        $newCity,
        $newState,
        $newZip,
        $newPassword,
        $oldUsername
    );

    // Execute the statement
    if (mysqli_stmt_execute($statement)) {
        // Redirect the user back to the profile page after successful update
        header("Location: profile.php?success=profile_updated");
        exit;
    } else {
        // Handle database update error
        header("Location: profile.php?error=database_error");
        exit;
    }

    // Close the statement
    mysqli_stmt_close($statement);
}
?>
