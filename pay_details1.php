<?php 

	// connect to db
	include('config/db_connect_admin.php');

	// check get request id parameter
	if (isset($_GET['id'])) {

		$c_id = mysqli_real_escape_string($connect, $_GET['id']);

		//echo $c_id;

		// make sql
		$pay_sql = "SELECT payment_id, pdate FROM payment WHERE customer_id = $c_id ORDER BY payment_id";

		// get query result
		$pay_result = mysqli_query($connect, $pay_sql);

		// fetch result in array format
		$payment = mysqli_fetch_all($pay_result, MYSQLI_ASSOC);

		//print_r($payment);

		mysqli_free_result($pay_result);
		mysqli_close($connect);		
	}

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center darkslategray-text">Payments</h4>
	<div class="container">
		<div class="row">
			<?php if($payment): ?>
				<?php foreach ($payment as $pmt): ?>
					<div class="col s6 md3">
						<div class="card z-depth-0">
							<!-- <img src="img/Me2.jpg" class="customer"> -->
							<div class="card-content center">

								<h6><?php echo htmlspecialchars($pmt['payment_id']); ?></h6>
								<!-- <p>Payment id: <?php echo htmlspecialchars($pmt['payment_id']); ?></p> -->
								<p><?php echo date($pmt['pdate']); ?></p> 
							
							</div>
							<div class="card-action right-align">
								<a class="brand-text" href="pay_details2.php?id=<?php echo $pmt['payment_id']?>">more info</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>

 				<h5 class="center">No payments done by this customer</h5>
 			
 			<?php endif; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>