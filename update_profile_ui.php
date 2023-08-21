<h3>Edit Profile</h3><br>
<form id="edit-profile-form" action="update_profile.php" method="POST">
    <!-- Add form fields for updating profile information -->
    <label for="new-username">New Username:</label><br>
    <input type="text" id="new-username" name="new-username" required><br><br>
    <label for="new-email">New Email:</label><br>
    <input type="email" id="new-email" name="new-email" required><br><br>
    <label for="new-mobile">New Mobile:</label><br>
    <input type="text" id="new-mobile" name="new-mobile" required><br><br>
    <label for="new-address">New Address:</label><br>
    <input type="text" id="new-address" name="new-address" required><br><br>
    <label for="new-city">New City:</label><br>
    <input type="text" id="new-city" name="new-city" required><br><br>
    <label for="new-state">New State:</label><br>
    <input type="text" id="new-state" name="new-state" required><br><br>
    <label for="new-zip">New Zip:</label><br>
    <input type="text" id="new-zip" name="new-zip" required><br><br>
    <label for="new-password">New Password:</label><br>
    <input type="password" id="new-password" name="new-password" required><br><br>
    <label for="confirm-password">Confirm Password:</label><br>
    <input type="password" id="confirm-password" name="confirm-password" required><br><br>
    <input type="hidden" name="old-username" value="<?php echo $row['username'];?>">
    <button type="submit">Save Changes</button><br>
</form>
