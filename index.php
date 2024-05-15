<?php
include ('includes/config.php');
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
} else {
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($password === $row['password']) {
				session_start();

				$_SESSION['loggedIn'] = true;

				$_SESSION['userData'] = $row;

				$_SESSION['user_id'] = $row['id'];

				if ($row['role'] == 1) { // Admin role
					header('Location: pages/admin_dashboard');
				} else { // Other roles
					header('Location: pages/dashboard');
				}
				exit;
			} else {
				echo "<script language=\"JavaScript\">\n";
				echo "alert('Username or Password was incorrect!');\n";
				echo "window.location='index'";
				echo "</script>";
			}
		} else {
			echo "<script language=\"JavaScript\">\n";
			echo "alert('Username or Password was incorrect!');\n";
			echo "window.location='index'";
			echo "</script>";
		}
	}

}
// Check for success or error query parameters
if (isset($_GET['alert'])) {
	if ($_GET['alert'] === 'success') {
		echo "<script>alert('User registered successfully');";
		echo "window.location='index'</script>";
	} elseif ($_GET['alert'] === 'error') {
		// Decode the message parameter and display the error alert
		$errorMessage = isset($_GET['message']) ? urldecode($_GET['message']) : "An error occurred.";
		echo "<script>alert('$errorMessage');
		window.location='index'
		</script>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="icon" href="assets/img/headerlogo.png" type="image/icon type">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<style>
		.bg-custom {
			background-color: #23282d;
			color: white;
		}
	</style>
</head>

<body>
	<div class="container mt-5">
		<div class="row d-flex justify-content-center">
			<div class="col-lg-5 col-md-8 col-sm-10">
				<div class="card bg-custom">
					<div class="card-body p-4">
						<h2 class="text-center mb-4">Disaster Management Portal</h2>
						<p class="text-center">Sign in with your account to continue</p>
						<form action="" method="POST">
							<div class="form-group mb-3">
								<label for="email" class="form-label">Username:</label>
								<input type="email" id="email" name="email" placeholder="Enter your username"
									class="form-control text-dark" required>
							</div>

							<div class="form-group mb-3">
								<label for="password" class="form-label">Password:</label>
								<input type="password" id="password" name="password" placeholder="Enter your password"
									class="form-control" required>
							</div>

							<div class="form-check mb-3">
								<input type="checkbox" class="form-check-input" id="checkbox"
									onclick="togglePasswordVisibility()">
								<label class="form-check-label" for="checkbox">Show Password</label>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary w-100" name="login">Login</button>
							</div>
						</form>
					</div>
					<div class="row mt-3">
						<div class="col text-center">
							<p class="text-light">Don't have an account? <a href="register" target="_blank">Sign
									up</a></p>
							<p class="text-light">Forgot your password? <a href="#">Reset it</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<script>
		function togglePasswordVisibility() {
			var passwordField = document.getElementById("password");
			var checkbox = document.getElementById("checkbox");

			if (checkbox.checked) {
				passwordField.type = "text";
			} else {
				passwordField.type = "password";
			}
		}
	</script>

</body>

</html>