<?php
session_start();
require_once("./config.php");
require_once("./Function.php");
if (isset($_SESSION["admin_id"])) {
	header('Location: Dashboard.php');
}
$error = '';
if (isset($_POST["Admin_Login"])) {

	$username      = get_safe_value($con,$_POST["username"]);
	$password   = get_safe_value($con,$_POST["password"]);
	$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
	$result = mysqli_query($con, $query);
	$count = mysqli_num_rows($result);
	$row = $result->fetch_assoc();

	if ($row) {

		//Authentication 
		$_SESSION["admin_id"] = $row["a_id"];
		//Redirect to dashboard
		header("Location: Dashboard.php");
	} else {
?>
		<script src="./Admin_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
		<script>
			$(document).ready(function() {
				swal({
					title: "ERROR!",
					text: "Invalid Username or Password!",
					icon: "error",
					button: "Retry",
				});
			})
		</script> <?php
				}
			}
					?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>ABS Enterprises</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="./Admin_Login/images/icons/sheen.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Admin_Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="./Admin_Login/css/main.css">
	<!--===============================================================================================-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form action="index.php" method="POST" class="login100-form validate-form">
					<div class="login100-form-avatar">
						<img src="./Admin_Login/images/admin.jpg" alt="AVATAR" width="100%" height="100%">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
					ABS Enterprises
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Password is required" required>
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">

						<input type="submit" class="login100-form-btn" value="Login" name="Admin_Login">

					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="./Admin_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="./Admin_Login/vendor/bootstrap/js/popper.js"></script>
	<script src="./Admin_Login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="./Admin_Login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="./Admin_Login/js/main.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>