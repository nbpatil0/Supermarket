
<?php include('login/dbcon.php'); 
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$query =  mysqli_query($con, "SELECT * FROM users WHERE  password='$password' and username='$username'") or die($mysqli_error($conn));
	$run = mysqli_num_rows($query);

	if($run==0) {
		$error = "<span class='red'> Please enter correct password </span>";
		header('location: index.php?error='. $error);
	}
	else {
		$row = mysqli_fetch_array($query);
		$_SESSION['username'] =$row['username'];
		$_SESSION['password'] =$row['password'];
		header('location: mainpage.php');
	}


?>