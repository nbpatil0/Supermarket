<?php 

	//connect to db
	include('config/db_connect_admin.php');

	if (isset($_POST['delete'])) {
		
		$id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);

		$e_sql = "DELETE FROM employee WHERE employee_id = $id_to_delete";

		if (mysqli_query($connect, $e_sql)) {
			// success
			header('Location: e_index.php');

		} else {
			// faliure
			echo 'query error: ' . mysqli_error($connect);
		}
	}

	// check get request id parameter
	if (isset($_GET['id'])) {

		$e_id = mysqli_real_escape_string($connect, $_GET['id']);

		// make sql
		$e_sql = "SELECT * FROM employee e, address a WHERE e.employee_id = $e_id AND a.zipcode = e.zipcode";

		// get query result
		$e_result = mysqli_query($connect, $e_sql);

		// fetch result in array format
		$employee = mysqli_fetch_assoc($e_result);

		//print_r($customer);

		mysqli_free_result($e_result);
		mysqli_close($connect);		
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

 	<div class="container center darkslategray-text">
 		<?php if($employee): ?>

 			<h4><?php echo htmlspecialchars($employee['name']); ?></h4>
 			<p>Email: <?php echo htmlspecialchars($employee['email']); ?></p>
 			<p>Phone number: <?php echo htmlspecialchars($employee['phone_no']); ?></p>
 			<p>Role: <?php echo htmlspecialchars($employee['role']); ?></p>

 			<h5>Address: </h5>
 			<p>City: <?php echo htmlspecialchars($employee['city']); ?></p>
 			<p>District: <?php echo htmlspecialchars($employee['district']); ?></p>
 			<p>State: <?php echo htmlspecialchars($employee['state']); ?></p>
 			<p>Zipcode: <?php echo htmlspecialchars($employee['zipcode']); ?></p>

 			<!-- Delete form -->
 			<form action="e_details.php" method="POST">
 				<input type="hidden" name="id_to_delete" value="<?php echo $employee['employee_id'] ?>">
 				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 			</form>

 		<?php else: ?>

 			<h5>No such employee exist!</h5>
 			
 		<?php endif; ?>
 	</div>

 	<?php include('templates/footer.php'); ?>
 
 </html>