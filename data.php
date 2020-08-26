<?php 
	require_once 'app/autoload.php';
	session_start();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap-table ">
		<a class="btn btn-sm btn-primary" href="profile.php">My Account</a>
		<div class="card shadow-sm">
			<div class="card-body">
				<h2>All Data</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>SI#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Username</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							/*Data retrive from database table(users)*/
							$sql = "SELECT * FROM users";
							$data = $connection -> query($sql);
							$i = 1;
							while ( $user_data = $data -> fetch_assoc()) :
						 ?>
						<tr>
							<td><?php echo $i;$i++ ?></td>
							<td><?php echo $user_data['name'] ?></td>
							<td><?php echo $user_data['email'] ?></td>
							<td><?php echo $user_data['uname'] ?></td>
							<td><img src="img/<?php echo $user_data['photo'] ?>" alt=""></td>
							<td>
								<?php if($_SESSION['id'] == $user_data['id']): ?>
									<!-- these two buttton available for only user -->
									<a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $user_data['id'] ?>">Edit</a>
									<a class="btn btn-sm btn-danger" href="#">Deactive</a>
								<?php else: ?>
									<!-- these buttton available for all -->
									<a class="btn btn-sm btn-info" href="userview.php?id=<?php echo $user_data['id'] ?>">View</a>
								<?php endif; ?>
							</td>
						</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
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