<?php 

	//connect to db
	include('config/db_connect_admin.php');

	if (isset($_POST['delete'])) {
		
		$id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);

		$ps_sql = "DELETE FROM product_shelves WHERE shelf_id = $id_to_delete";

		if (mysqli_query($connect, $ps_sql)) {
			// success
			header('Location: ps_index.php');

		} else {
			// faliure
			echo 'query error: ' . mysqli_error($connect);
		}
	}

	// check get request id parameter
	if (isset($_GET['id'])) {

		$ps_id = mysqli_real_escape_string($connect, $_GET['id']);

		// make sql
		$ps_sql = "SELECT * FROM product_shelves WHERE shelf_id = $ps_id";

		// get query result
		$ps_result = mysqli_query($connect, $ps_sql);

		// fetch result in array format
		$product_shelves = mysqli_fetch_assoc($ps_result);

		mysqli_free_result($ps_result);
		mysqli_close($connect);		
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

 	<div class="container center darkslategray-text">
 		<?php if($product_shelves): ?>

 			<h4><?php echo htmlspecialchars($product_shelves['category']); ?></h4>
 			
 			<p>Type: <?php echo htmlspecialchars($product_shelves['type']); ?></p>

 			<!-- Delete form -->
 			<form action="ps_details.php" method="POST">
 				<input type="hidden" name="id_to_delete" value="<?php echo $product_shelves['shelf_id'] ?>">
 				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 			</form>

 		<?php else: ?>

 			<h5>No such Product Shelf exist!</h5>
 			
 		<?php endif; ?>
 	</div>

 	<?php include('templates/footer.php'); ?>
 
 </html>