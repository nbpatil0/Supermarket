<?php 

	// connect to db
	include('config/db_connect_admin.php');

	//write quarry for all customers
	$ps_sql = 'SELECT shelf_id, category, type  FROM product_shelves ORDER BY shelf_id';

	// make quarry & get result
	$ps_result = mysqli_query($connect, $ps_sql);

	//fetch the resulting rows as an array
	$product_shelves = mysqli_fetch_all($ps_result, MYSQLI_ASSOC);

	//freeing the result from memory
	mysqli_free_result($ps_result);

	// close connection
	mysqli_close($connect);

	#explode function (reffer L28)
	//explode(',', $pizzas[0]['ingredients'])

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center darkred-text">Product Shelves</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($product_shelves as $pdt_slf): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!-- <img src="img/Me2.jpg" class="customer"> -->
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pdt_slf['shelf_id']); ?></h6>
							<div><?php echo htmlspecialchars($pdt_slf['category']); ?></div>
							<div>Type: <?php echo htmlspecialchars($pdt_slf['type']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="ps_details.php?id=<?php echo $pdt_slf['shelf_id']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>