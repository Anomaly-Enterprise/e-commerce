<?php
use Phppot\Member;
if (! empty($_POST["signup-btn"])) {
    require_once './Model/Member.php';
    $member = new Member();
    $registrationResponse = $member->registerMember();
	if ($registrationResponse) {
        header('Location:./login.php');
    }
}
?>
<HTML>

<HEAD>
	<TITLE>User Registration</TITLE>
	<link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
	<link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
	<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>

<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="login-signup">
				<a href="login.php">Login</a>
			</div>
			<div class="">
				<form name="sign-up" action="" method="post" onsubmit="return signupValidation()">
					<div class="signup-heading">Registration</div>
					<?php
    					if (! empty($registrationResponse["status"])) {
					?>
					<?php
        					if ($registrationResponse["status"] == "error") {
					?>
					<div class="server-response error-msg"><?php echo $registrationResponse["message"]; ?></div>
					<?php
        					} else if ($registrationResponse["status"] == "success") {
            		?>
					<div class="server-response success-msg"><?php echo $registrationResponse["message"]; header('Location: login.php'); ?></div>
					<?php
        					}
       				?>
					<?php
    					}
    				?>
					<div class="error-msg" id="error-msg"></div>
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
								Email<span class="required error" id="email-info"></span>
							</div>
							<input class="input-box-330" type="email" name="email" id="email">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Mobile No.<span class="required error" id="mobile-info"></span>
							</div>
							<input class="input-box-330" type="text" name="mobile" id="mobile">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Address<span class="required error" id="address-info"></span>
							</div>
							<input class="input-box-330" type="textarea" name="address" id="address">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								City<span class="required error" id="address-info"></span>
							</div>
							<input class="input-box-330" type="text" name="city" id="city">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								State<span class="required error" id="address-info"></span>
							</div>
							<input class="input-box-330" type="text" name="state" id="state">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Zip<span class="required error" id="address-info"></span>
							</div>
							<input class="input-box-330" type="number" name="zip" id="zip">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error" id="signup-password-info"></span>
							</div>
							<input class="input-box-330" type="password" name="signup-password" id="signup-password">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Confirm Password<span class="required error" id="confirm-password-info"></span>
							</div>
							<input class="input-box-330" type="password" name="confirm-password" id="confirm-password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="signup-btn" id="signup-btn" value="Sign up">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		function signupValidation() {
			var valid = true;

			$("#username").removeClass("error-field");
			$("#email").removeClass("error-field");
			$("#mobile").removeClass("error-field");
			$("#address").removeClass("error-field");
			$("#city").removeClass("error-field");
			$("#state").removeClass("error-field");
			$("#zip").removeClass("error-field");
			$("#password").removeClass("error-field");
			$("#confirm-password").removeClass("error-field");

			var UserName = $("#username").val();
			var email = $("#email").val();
			var mobile = $("#mobile").val();
			var address = $("#address").val();
			var city = $("#city").val();
			var state = $("#state").val();
			var zip = $("#zip").val();
			var Password = $('#signup-password').val();
			var ConfirmPassword = $('#confirm-password').val();
			var usernameRegex = /^[a-zA-Z0-9]+$/;
			var emailRegex =
				/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
			var mobileRegex = /^[0-9]{10}$/;
			var addressRegex = /^[a-zA-Z0-9]+$/;
			var cityRegex = /^[a-zA-Z]+$/;
			var stateRegex = /^[a-zA-Z]+$/;
			var zipRegex = /^[0-9]{6}$/;

			$("#username-info").html("").hide();
			$("#email-info").html("").hide();
			$("#mobile-info").html("").hide();
			$("#address-info").html("").hide();
			$("#city-info").html("").hide();
			$("#state-info").html("").hide();
			$("#zip-info").html("").hide();


			if (UserName.trim() == "") {
				$("#username-info").html("required.").css("color", "#ee0000").show();
				$("#username").addClass("error-field");
				valid = false;
			}
			if (email == "") {
				$("#email-info").html("required").css("color", "#ee0000").show();
				$("#email").addClass("error-field");
				valid = false;
			} else if (email.trim() == "") {
				$("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
				$("#email").addClass("error-field");
				valid = false;
			} else if (!emailRegex.test(email)) {
				$("#email-info").html("Invalid email address.").css("color", "#ee0000")
					.show();
				$("#email").addClass("error-field");
				valid = false;
			}
			if (mobile.trim() == "") {
				$("#mobile-info").html("required.").css("color", "#ee0000").show();
				$("#mobile").addClass("error-field");
				valid = false;
			} else if (!mobileRegex.test(mobile)) {
				$("#mobile-info").html("Invalid mobile number.").css("color", "#ee0000").show();
				$("#mobile").addClass("error-field");
				valid = false;
			}
			if (address.trim() == "") {
				$("#address-info").html("required.").css("color", "#ee0000").show();
				$("#address").addClass("error-field");
				valid = false;
			}
			if (city.trim() == "") {
				$("#city-info").html("required.").css("color", "#ee0000").show();
				$("#city").addClass("error-field");
				valid = false;
			}
			if (state.trim() == "") {
				$("#state-info").html("required.").css("color", "#ee0000").show();
				$("#state").addClass("error-field");
				valid = false;
			}
			if (zip.trim() == "") {
				$("#zip-info").html("required.").css("color", "#ee0000").show();
				$("#zip").addClass("error-field");
				valid = false;
			}
			if (!zipRegex.test(zip)) {
                $("#zip-info").html("Invalid zip code.").css("color", "#ee0000").show();
                $("#zip").addClass("error-field");
                valid = false;
            }
			if (Password.trim() == "") {
				$("#signup-password-info").html("required.").css("color", "#ee0000").show();
				$("#signup-password").addClass("error-field");
				valid = false;
			}
			if (ConfirmPassword.trim() == "") {
				$("#confirm-password-info").html("required.").css("color", "#ee0000").show();
				$("#confirm-password").addClass("error-field");
				valid = false;
			}
			if (Password != ConfirmPassword) {
				$("#error-msg").html("Both passwords must be same.").show();
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