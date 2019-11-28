<?php 

	// connect to db
	include('config/db_connect_admin.php');

		//write quarry for all customers
	$pay_sql = 'SELECT customer_id, name FROM customer ORDER BY customer_id';

	// make quarry & get result
	$pay_result = mysqli_query($connect, $pay_sql);

	//fetch the resulting rows as an array
	$payment = mysqli_fetch_all($pay_result, MYSQLI_ASSOC);

	//freeing the result from memory
	mysqli_free_result($pay_result);
	// close connection
	mysqli_close($connect);

	#explode function (reffer L28)
	//explode(',', $pizzas[0]['ingredients'])

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center darkred-text">Customers</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($payment as $pmt): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!-- <img src="img/Me2.jpg" class="customer"> -->
						<div class="card-content center">

							<h6><?php echo htmlspecialchars($pmt['customer_id']); ?></h6>
							<p>Name: <?php echo htmlspecialchars($pmt['name']); ?></p>
							
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="pay_details1.php?id=<?php echo $pmt['customer_id']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>