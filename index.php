<?php 
	require_once 'app/autoload.php';


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap ">
		<div class="card shadow-sm">
			<div class="card-body">
				<h2>Log In</h2>
				<form action = "" method = "POST">
					<div class="form-group">
						<label for="">Username / Email</label>
						<input class="form-control" type="text" name="login_data">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input class="form-control" type="password" name="pass">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="Login" name="login">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="register.php">Create an account</a>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>