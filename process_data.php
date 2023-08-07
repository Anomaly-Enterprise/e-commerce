<!DOCTYPE html>
<html>
<head>
    <title>Processed Data</title>
</head>
<body>
    <?php
        // Check if the paymentID is present in the query parameter
        if (isset($_GET['paymentID'])) {
            // Get the paymentID from the query parameter
            $paymentID = $_GET['paymentID'];
            echo "<h1>Payment ID: " . htmlspecialchars($paymentID) . "</h1>";
        } else {
            echo "<h1>No paymentID received!</h1>";
        }
    ?>
</body>
</html>