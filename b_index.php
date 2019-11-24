<?php 

	// connect to db
	include('config/db_connect_admin.php');

	//write quarry for all customers
	$b_sql = 'SELECT b.bill_no, c.name, b.bdate  FROM customer c, billing_counter b WHERE c.customer_id = b.customer_id ORDER BY b.bill_no';

	// make quarry & get result
	$b_result = mysqli_query($connect, $b_sql);

	//fetch the resulting rows as an array
	$bill = mysqli_fetch_all($b_result, MYSQLI_ASSOC);

	//freeing the result from memory
	mysqli_free_result($b_result);

	// close connection
	mysqli_close($connect);

	#explode function (reffer L28)
	//explode(',', $pizzas[0]['ingredients'])

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center darkred-text">Bills</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($bill as $bil): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!-- <img src="img/Me2.jpg" class="customer"> -->
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($bil['bill_no']); ?></h6>
							<div>Name: <?php echo htmlspecialchars($bil['name']); ?></div>
							<div>Paid on: <?php echo date($bil['bdate']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="b_details.php?id=<?php echo $bil['bill_no']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>