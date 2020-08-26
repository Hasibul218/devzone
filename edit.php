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
	/*Data retrive from database table(users)*/
	if (isset($_GET['edit_id'])) {
		$eid = $_GET['edit_id'];
	}

	
	/**
	 * Update User Information
	 */
	if (isset($_POST['update'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];

		if (empty($name) || empty($email)) {
			$mess = "<p class='alert alert-danger'>All fields are recquired !<button class='close' data-dismiss='alert'>&times;</button></p>";
		}else{
			/*file upload*/
			if (!empty($_FILES['new_photo']['name'])) {
				$photo_data = fileUpload($_FILES['new_photo']);
				$photo_name = $photo_data['file_name'];
				$mess = $photo_data['mess'];
			}else{
				$photo_name = $_POST['old_photo'];
			}
			$sql = "UPDATE users SET name = '$name', email = '$email', photo = '$photo_name' WHERE id = '$eid'";
			$connection -> query($sql);
			$mess = "<p class='alert alert-success'>Profile Updated Successful.<button class='close' data-dismiss='alert'>&times;</button></p>";
			$_SESSION['photo'] = $photo_name;
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
		}
	}
	$sql = "SELECT * FROM users WHERE id = $eid";
	$data = $connection -> query($sql);
	$user_data = $data -> fetch_assoc();
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
		<a class="btn btn-sm btn-primary" href="changepass.php">Change Password</a>
		<div class="card shadow-sm">
			<div class="card-body">
				<h6>
					<?php if (isset($mess)) {
						echo $mess;
					} ?>
				</h6>
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>User Name </label>
						<input type="text" class="form-control"  value="<?php echo $user_data['uname'] ?>" disabled>
					</div>
					<div class="form-group">
						<label>Name </label>
						<input type="text" class="form-control" value="<?php echo $user_data['name'] ?>" name= "name">
					</div>
					<div class="form-group">
						<label>Email </label>
						<input type="text" class="form-control" value="<?php echo $user_data['email'] ?>" name= "email">
					</div>
					<div class="form-group">
						<img class="shadow-sm" style="width: 200px;height: 200px;" src="img/<?php echo $user_data['photo'] ?>" alt="">
						<input type="hidden" name="old_photo" value="<?php echo $user_data['photo'] ?>">
					</div>
					<div class="form-group">
						<label>Photo </label>
						<input type="file" class="form-control" name= "new_photo">
					</div>
					<div class="form-group"> 
						<input class="btn btn-primary" type="submit" value="Update" name="update">
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