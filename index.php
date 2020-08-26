<?php 
	require_once 'app/autoload.php';
	session_start();

	if (isset($_POST['login'])) {
		$login_data = $_POST['login_data'];
		$pass = $_POST['pass'];

		if (empty($login_data) || empty($pass)) {
			$mess = "<p class='alert alert-danger'>Email or Password recquired !<button class='close' data-dismiss='alert'>&times;</button></p>";
		}else{
			$sql = "SELECT * FROM users WHERE email = '$login_data' || uname = '$login_data'";
			$data = $connection -> query($sql);
			$user_rows = $data -> num_rows;
			$login_user = $data -> fetch_assoc();
			if ($user_rows > 0) {
				if (password_verify($pass, $login_user['pass']) == true) {
						$_SESSION['uname'] = $login_user['uname'];
						$_SESSION['id'] = $login_user['id'];
						$_SESSION['name'] = $login_user['name'];
						$_SESSION['email'] = $login_user['email'];
						$_SESSION['photo'] = $login_user['photo'];
						header('location: profile.php');
				}else{
					$mess = "<p class='alert alert-warning'>Wrong password*<button class='close' data-dismiss='alert'>&times;</button></p>";
				}
			}else{
				$mess = "<p class='alert alert-danger'>Email or username not exist!<button class='close' data-dismiss='alert'>&times;</button></p>";
			}
		}
	}

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
				<!-- all error message -->
				<?php 
					if (isset($mess)) {
						echo $mess;
					}
				 ?>
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