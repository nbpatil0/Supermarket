<?php 

	// connect to db
	include('config/db_connect_admin.php');

	//write quarry for all customers
	$p_sql = 'SELECT p.model_id, n.name, p.type  FROM product p, p_name n WHERE n.name_id = p.name_id ORDER BY p.model_id';

	// make quarry & get result
	$p_result = mysqli_query($connect, $p_sql);

	//fetch the resulting rows as an array
	$product = mysqli_fetch_all($p_result, MYSQLI_ASSOC);

	//print_r($product);

	//freeing the result from memory
	mysqli_free_result($p_result);

	// close connection
	mysqli_close($connect);

	#explode function (reffer L28)
	//explode(',', $pizzas[0]['ingredients'])

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center darkred-text">Products</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($product as $pdt): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!-- <img src="img/Me2.jpg" class="customer"> -->
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pdt['model_id']); ?></h6>
							<div><?php echo htmlspecialchars($pdt['name']); ?></div>
							<div>Type: <?php echo htmlspecialchars($pdt['type']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="p_details.php?id=<?php echo $pdt['model_id']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>