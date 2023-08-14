<?php
// include 'include/db_connection.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecomm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $useremail = isset($_POST['useremail']) ? mysqli_real_escape_string($conn, $_POST['useremail']) : '';
    $usercontact = isset($_POST['usercontact']) ? mysqli_real_escape_string($conn, $_POST['usercontact']) : '';
    $useraddress = isset($_POST['useraddress']) ? mysqli_real_escape_string($conn, $_POST['useraddress']) : '';
    $usercity = isset($_POST['usercity']) ? mysqli_real_escape_string($conn, $_POST['usercity']) : '';
    $userstate = isset($_POST['userstate']) ? mysqli_real_escape_string($conn, $_POST['userstate']) : '';
    $userpincode = isset($_POST['userpincode']) ? mysqli_real_escape_string($conn, $_POST['userpincode']) : '';

    if (!empty($username) && !empty($useremail) && !empty($usercontact) && !empty($useraddress) && !empty($usercity) && !empty($userstate) && !empty($userpincode)) {
        // Perform the update in the database
        $query = "UPDATE tbl_member SET username=?, email=?, mobile=?, address=?, city=?, state=?, zip=? WHERE email=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $username, $useremail, $usercontact, $useraddress, $usercity, $userstate, $userpincode, $useremail);
        
        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Address updated successfully!";
            echo $successMessage;
        } else {
            $errorMessage = "Error updating address: " . mysqli_error($conn);
            echo $errorMessage;
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Incomplete or missing data.";
    }

    mysqli_close($conn);
}
?>
