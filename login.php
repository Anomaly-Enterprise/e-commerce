<?php
use Phppot\Member;
use Phppot\Admin;

if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '/Model/Member.php';
	require_once __DIR__ . '/Model/Admin.php';

    $member = new Member();
    $loginResult = $member->loginMember();

	if ($loginResult !== "success") {
        // The member login failed, so check if it's an admin login
        $admin = new Admin();
        $isAdmin = $admin->isAdminExists($_POST["username"], $_POST["login-password"]);
        if ($isAdmin) {
            // The admin login is successful. Perform the necessary actions.
            // For example, you can redirect to the admin dashboard.
            header("Location: ./admin/admin_dashboard.php");
            exit();
        } else {
            // The login failed for both member and admin credentials.
            // Handle the error message or redirect to the login page.
            $errorMessage = "Invalid username or password.";
            // ...
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
</BODY>

</HTML>