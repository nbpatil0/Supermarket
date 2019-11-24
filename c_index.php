<?php 

	// connect to db
	include('config/db_connect_admin.php');

	//write quarry for all customers
	$c_sql = 'SELECT customer_id, name, email  FROM customer ORDER BY customer_id';

	// make quarry & get result
	$c_result = mysqli_query($connect, $c_sql);

	//fetch the resulting rows as an array
	$customer = mysqli_fetch_all($c_result, MYSQLI_ASSOC);

	//print_r($customer);

	//freeing the result from memory
	mysqli_free_result($c_result);

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
			<?php foreach ($customer as $cust): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!-- <img src="img/Me2.jpg" class="customer"> -->
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($cust['customer_id']); ?></h6>
							<div><?php echo htmlspecialchars($cust['name']); ?></div>
							<div><?php echo htmlspecialchars($cust['email']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="c_details.php?id=<?php echo $cust['customer_id']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>