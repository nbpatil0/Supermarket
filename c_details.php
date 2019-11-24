<?php 

	//connect to db
	include('config/db_connect_admin.php');

	if (isset($_POST['delete'])) {
		
		$id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);

		$c_sql = "DELETE FROM customer WHERE customer_id = $id_to_delete";

		if (mysqli_query($connect, $c_sql)) {
			// success
			header('Location: c_index.php');

		} else {
			// faliure
			echo 'query error: ' . mysqli_error($connect);
		}
	}

	// check get request id parameter
	if (isset($_GET['id'])) {

		$c_id = mysqli_real_escape_string($connect, $_GET['id']);

		// make sql
		$c_sql = "SELECT * FROM customer c, address a WHERE c.customer_id = $c_id AND a.zipcode = c.zipcode";

		// get query result
		$c_result = mysqli_query($connect, $c_sql);

		// fetch result in array format
		$customer = mysqli_fetch_assoc($c_result);

		//print_r($customer);

		mysqli_free_result($c_result);
		mysqli_close($connect);		
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

 	<div class="container center darkslategray-text">
 		<?php if($customer): ?>

 			<h4><?php echo htmlspecialchars($customer['name']); ?></h4>
 			<p>Email: <?php echo htmlspecialchars($customer['email']); ?></p>
 			<p>Phone number: <?php echo htmlspecialchars($customer['phone_no']); ?></p>

 			<h5>Address: </h5>
 			<p>City: <?php echo htmlspecialchars($customer['city']); ?></p>
 			<p>District: <?php echo htmlspecialchars($customer['district']); ?></p>
 			<p>State: <?php echo htmlspecialchars($customer['state']); ?></p>
 			<p>Zipcode: <?php echo htmlspecialchars($customer['zipcode']); ?></p>

 			<!-- Delete form -->
 			<form action="c_details.php" method="POST">
 				<input type="hidden" name="id_to_delete" value="<?php echo $customer['customer_id'] ?>">
 				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 			</form>

 		<?php else: ?>

 			<h5>No such customer exist!</h5>
 			
 		<?php endif; ?>
 	</div>

 	<?php include('templates/footer.php'); ?>
 
 </html>