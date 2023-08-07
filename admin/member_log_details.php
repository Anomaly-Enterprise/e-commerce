<!-- member_log_details.php -->

<?php
// Open a new MySQLi connection
include '../include/db_connection.php';

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<h1>Member Log Table</h1>
<div class="table-container">
<table class="table">
    <thead>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Timestamp</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Fetch data from the tbl_member_log table
    $query = "SELECT * FROM tbl_member_logs";
    $result = $conn->query($query);
    while ($log = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $log['username']; ?></td>
            <td><?php echo $log['email']; ?></td>
            <td><?php echo $log['time']; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>
<?php
// Close the connection
mysqli_close($conn);
?>
