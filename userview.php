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
	/*Data retrive specfic user from database*/
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$sql = "SELECT * FROM users WHERE id = $id";
	$data = $connection -> query($sql);
	$user_data = $data -> fetch_assoc();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User View</title>
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
				<img class="shadow-sm" style="width: 200px;height: 200px;border:10px solid #FFF;border-radius:50%; margin: auto; display:block;" src="img/<?php echo $user_data['photo'] ?>" alt="">
				<h2 style="text-align: center"> <?php echo $user_data['name'] ?> </h2>
				<hr>
				<table class="table table-striped">
					<tr>
						<td>Name :</td>
						<td><?php echo $user_data['name'] ?></td>
					</tr>
					<tr>
						<td>User Name :</td>
						<td><?php echo $user_data['uname'] ?></td>
					</tr>
					<tr>
						<td>Email :</td>
						<td><?php echo $user_data['email'] ?></td>
					</tr>
				</table>
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