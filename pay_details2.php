<?php 

	//connect to db
	include('config/db_connect_admin.php');

	if (isset($_POST['go_to_bill'])) {
		
		$id_to_b_details = mysqli_real_escape_string($connect, $_POST['id_to_b_details']);
		
		header("Location: b_details.php?id=$id_to_b_details");
		//header("Location: b_cart.php?bill_no=$p_cid1&c_id=$customer");
	}

	// check get request id parameter
	if (isset($_GET['id'])) {

		$pay_id = mysqli_real_escape_string($connect, $_GET['id']);

		// make sql
		$pay_sql = "SELECT * FROM payment WHERE payment_id = $pay_id";
		$pay_sql2  = "SELECT c.name FROM customer c, payment p WHERE p.payment_id = $pay_id AND c.customer_id = p.customer_id";

		// get query result
		$pay_result = mysqli_query($connect, $pay_sql);

		// fetch result in array format
		$payment = mysqli_fetch_assoc($pay_result);

		$pay_result2 = mysqli_query($connect, $pay_sql2);

		// fetch result in array format
		$payment2 = mysqli_fetch_assoc($pay_result2);

		mysqli_free_result($pay_result);
		mysqli_free_result($pay_result2);
		mysqli_close($connect);		
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

 	<div class="container center darkslategray-text">
 		<?php if($payment): ?>

 			<h4><?php echo htmlspecialchars($payment['payment_id']); ?></h4>
 			<p>Name: <?php echo htmlspecialchars($payment2['name']); ?></p>
 			<p>Paid on: <?php echo date($payment['pdate']); ?></p>
 			<p>Amount: Rs. <?php echo htmlspecialchars($payment['amount']); ?>/-</p>
 			<p>Mode of payment: <?php echo htmlspecialchars($payment['mode']); ?></p>

 			<!-- Delete form -->
 			<form action="pay_details2.php" method="POST">
 				<input type="hidden" name="id_to_b_details" value="<?php echo $payment['bill_no'] ?>">
 				<input type="submit" name="go_to_bill" value="Go to Bill" class="btn brand z-depth-0">
 			</form>

 		<?php else: ?>

 			<h5>No such Payment exist!</h5>
 			
 		<?php endif; ?>
 	</div>

 	<?php include('templates/footer.php'); ?>
 
 </html>