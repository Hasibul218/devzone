<?php 
	require_once 'app/autoload.php';

	/**
	 * submit button start here
	 */
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		//$photo = $_POST['photo'];

		if (empty($name) || empty($uname) || empty($email) || empty($pass)) {
			$mess = "<p class='alert alert-danger'>All fields are recquired !<button class='close' data-dismiss='alert'>&times;</button></p>";
		}else{
			/**
			 * data check from users table
			 */
			if (datacheck($connection, 'users', 'email', $email) == false) {
				$mess = "<p class='alert alert-warning'>Email already exist !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif (datacheck($connection, 'users', 'uname', $uname) == false) {
				$mess = "<p class='alert alert-warning'>Username already exist !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{
				/**
				 * file upload
				 */
				$photo_data = fileUpload($_FILES['photo']);
				$photo_name = $photo_data['file_name'];
				$mess = $photo_data['mess'];

				$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

				$sql = "INSERT INTO `users`(`id`, `name`, `uname`, `email`, `pass`, `photo`) VALUES (NULL, '$name', '$uname', '$email', '$pass_hash', '$photo_name')";
				$connection -> query($sql);
				header('location: index.php');

			}
		}
	}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration Page</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap ">
		<div class="card shadow-sm">
			<div class="card-body">
				<h2>Create an account</h2>
				<!-- all message are showing here -->
				<?php 
					if (isset($mess)) {
						echo $mess;
					}
				 ?>
				<form method = "POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control" type="text" name="name">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" type="text" name="uname">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" type="text" name="email">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input class="form-control" type="password" name="pass">
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<input class="form-control" type="file" name="photo">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="SignUp" name="submit">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="index.php">Login Now</a>
			</div>
		</div>
	</div>
	

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