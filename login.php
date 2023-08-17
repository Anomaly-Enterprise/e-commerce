<?php
include 'include/header.php';
use Phppot\Member;
use Phppot\Admin;

// Check if the user is already authenticated
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header('Location: home.php'); // Redirect to the home page or a different page
    exit();
}

if (!empty($_POST["login-btn"])) {
    require_once __DIR__ . '/Model/Member.php';
    require_once __DIR__ . '/Model/Admin.php';

    $member = new Member();
    $username = $_POST["username"];
    $password = $_POST["login-password"];

    $loginResult = $member->loginMember($username, $password);

    if ($loginResult === "success") {
        // User is successfully logged in
        session_start();
		$_SESSION["authenticated"] = true; // Set the authentication flag
        // Check if the remember me checkbox is checked
        if (!empty($_POST["remember"])) {
            // Set a cookie to remember the user's login
            $cookie_name = "remember_login";
            $cookie_value = $username; // You can set the desired value here
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 30 days
        }

        // Redirect the user to home.php
        header('Location: home.php');
        exit();
    } else {
        // User login failed
        $admin = new Admin();
        $isAdmin = $admin->isAdminExists($username, $password); // Modify this function accordingly
        
        if ($isAdmin) {
			// Set a cookie for admin
			$cookie_name = "admin_login";
			$cookie_value = $username; // You can set the desired value here
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 30 days
			header('Location: ./admin/index.php'); // Redirect to admin/index.php
			exit();
		
        } else {
            $errorMessage = "Invalid username or password.";
        }
    }
}
?>

<HTML>

<HEAD>
	<TITLE>Login</TITLE>
	<link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
	<link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
	<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>

<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="login-signup">
				<a href="user-registration.php">Sign up</a>
			</div>
			<div class="signup-align">
				<form name="login" action="" method="post" onsubmit="return loginValidation()">
					<div class="signup-heading">Login</div>
					<?php if(!empty($loginResult)){?>
					<div class="error-msg"><?php echo $loginResult;?></div>
					<?php }?>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Username<span class="required error" id="username-info"></span>
							</div>
							<input class="input-box-330" type="text" name="username" id="username">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error" id="login-password-info"></span>
							</div>
							<input class="input-box-330" type="password" name="login-password" id="login-password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="login-btn" id="login-btn" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		function loginValidation() {
			var valid = true;
			$("#username").removeClass("error-field");
			$("#password").removeClass("error-field");

			var UserName = $("#username").val();
			var Password = $('#login-password').val();

			$("#username-info").html("").hide();

			if (UserName.trim() == "") {
				$("#username-info").html("required.").css("color", "#ee0000").show();
				$("#username").addClass("error-field");
				valid = false;
			}
			if (Password.trim() == "") {
				$("#login-password-info").html("required.").css("color", "#ee0000").show();
				$("#login-password").addClass("error-field");
				valid = false;
			}
			if (valid == false) {
				$('.error-field').first().focus();
				valid = false;
			}
			return valid;
		}
	</script>
<?php include 'include/footer.php'; ?>