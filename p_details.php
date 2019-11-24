<?php 

	//connect to db
	include('config/db_connect_admin.php');

	if (isset($_POST['delete'])) {
		
		$id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);

		$p_sql = "DELETE FROM p_name WHERE name_id = $id_to_delete";

		if (mysqli_query($connect, $p_sql)) {
			// success
			header('Location: p_index.php');

		} else {
			// faliure
			echo 'query error: ' . mysqli_error($connect);
		}
	}

	// check get request id parameter
	if (isset($_GET['id'])) {

		$p_id = mysqli_real_escape_string($connect, $_GET['id']);

		// make sql
		$p_sql = "SELECT * FROM product p, p_name n WHERE p.model_id = $p_id AND n.name_id = p.name_id";

		// get query result
		$p_result = mysqli_query($connect, $p_sql);

		// fetch result in array format
		$product = mysqli_fetch_assoc($p_result);

		mysqli_free_result($p_result);
		mysqli_close($connect);		
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

 	<div class="container center darkslategray-text">
 		<?php if($product): ?>

 			<h4><?php echo htmlspecialchars($product['name']); ?></h4>
 			<p>Type: <?php echo htmlspecialchars($product['type']); ?></p>
 			<p>Price: Rs. <?php echo htmlspecialchars($product['price']); ?>/-</p>
 			<p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>

 			<!-- Delete form -->
 			<form action="p_details.php" method="POST">
 				<input type="hidden" name="id_to_delete" value="<?php echo $product['name_id'] ?>">
 				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 			</form>

 		<?php else: ?>

 			<h5>No such Product exist!</h5>
 			
 		<?php endif; ?>
 	</div>

 	<?php include('templates/footer.php'); ?>
 
 </html>