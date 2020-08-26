<?php 
	require_once 'app/autoload.php';
	session_start();
	/**
	 * logout process
	 */
	if (isset($_GET['logout'])) {
		session_destroy();
		header('location: index.php');
	}
	/**
	 * page security
	 */
	if (!isset($_SESSION['uname'])) {
		header('location: index.php');
	}
	/**
	 * get change password id from all user page
	 */
	if (isset($_GET['cp_id'])) {
		$cp_id = $_GET['cp_id'];
	}
	/**
	 * Change Password Button Press
	 */
	if (isset($_POST['changepass'])) {
		$old_pass = $_POST['old_pass'];
		$new_pass = $_POST['new_pass'];
		$confirm_pass = $_POST['confirm_pass'];
		/*Password from database*/
		$sql = "SELECT pass from users WHERE id = '$cp_id'";
		$data = $connection -> query($sql);
		$dbpass = $data -> fetch_assoc();
		/*password match*/
		if (password_verify($old_pass, $dbpass['pass'])) {
			$match_pass = true;
		}else{
			$match_pass = false;
		}

		if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
			$mess = "<p class='alert alert-danger'>All fields are recquired !<button class='close' data-dismiss='alert'>&times;</button></p>";
		}elseif ($match_pass == false) {
			$mess = "<p class='alert alert-danger'>Password doesn't match.<button class='close' data-dismiss='alert'>&times;</button></p>";
		}elseif ($new_pass != $confirm_pass) {
			$mess = "<p class='alert alert-danger'>New password doesn't match.<button class='close' data-dismiss='alert'>&times;</button></p>";
		}else{
			$pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);
			$sql = "UPDATE users SET pass = '$pass_hash' WHERE id = '$cp_id'";
			$connection -> query($sql);
			header("location: index.php");
			session_destroy();
		}
	}

	
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	
	<div class="wrap ">
		<a class="btn btn-sm btn-primary" href="data.php">All users</a>
		<div class="card shadow-sm">
			<div class="card-body">
				<h6>
					<?php if (isset($mess)) {
						echo $mess;
					} ?>
				</h6>
				<form method="POST">
					<div class="form-group">
						<label>Old Password</label>
						<input type="password" class="form-control" name="old_pass">
					</div>
					<div class="form-group">
						<label>New Password </label>
						<input type="password" class="form-control" name= "new_pass">
					</div>
					<div class="form-group">
						<label>Confirm Password </label>
						<input type="password" class="form-control" name= "confirm_pass">
					</div>
					<div class="form-group"> 
						<input class="btn btn-primary" type="submit" value="Change Password" name="changepass">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<br>
	<br>
	<br>
	<br>



	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>