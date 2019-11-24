<?php 

	//connect to db
	include('config/db_connect_admin.php');

	// check get request id parameter
	if (isset($_GET['id'])) {

		$b_id = mysqli_real_escape_string($connect, $_GET['id']);

		// make sql
		$pay_sql = "SELECT b.bill_no, c.name, pay.payment_id, b.bdate, pay.amount FROM billing_counter b, customer c, payment pay WHERE b.bill_no = $b_id AND pay.bill_no = $b_id AND c.customer_id = b.customer_id";
		$pay_sql2  = "SELECT pn.name, c.quantity, c.amount FROM cart c, p_name pn, product p WHERE c.bill_no = $b_id AND p.model_id = c.model_id AND pn.name_id = p.name_id";

		// get query result
		$pay_result = mysqli_query($connect, $pay_sql);

		// fetch result in array format
		$bill = mysqli_fetch_assoc($pay_result);

		//print_r($bill);

		$pay_result2 = mysqli_query($connect, $pay_sql2);

		// fetch result in array format
		$items = mysqli_fetch_all($pay_result2, MYSQLI_ASSOC);

		//print_r($items);

		mysqli_free_result($pay_result);
		mysqli_free_result($pay_result2);
		mysqli_close($connect);		
	}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

 	<div class="container center darkslategray-text">
 		<?php if($bill): ?>

 			<h4><?php echo htmlspecialchars($bill['bill_no']); ?></h4>
 			<p>Name: <?php echo htmlspecialchars($bill['name']); ?></p>
 			<p>Paid on: <?php echo date($bill['bdate']); ?></p>
 			<p>Payment ID: <?php echo htmlspecialchars($bill['payment_id']); ?></p>
 			<div class="card-content center">
 				<table cellpadding="4">
 				<tr>
 					<td><strong>Name</strong></td>
 					<td><strong>Quantity</strong></td>
 					<td><strong>Price</strong></td>
 				</tr>

 				<?php foreach ($items as $key => $item): ?>
 			
 					<!-- <h5>Item<?php echo htmlspecialchars($key); ?></h5> -->
 					<tr>
 						<td><?php echo htmlspecialchars($item['name']); ?></td>
 						<td><?php echo htmlspecialchars($item['quantity']); ?></td>
 						<td><?php echo htmlspecialchars($item['amount']); ?></td>

 					</tr>
 				
 				<?php endforeach; ?>
 				</table>
 			</div>

 			<p>Total Amount: Rs. <?php echo htmlspecialchars($bill['amount']); ?>/-</p>
 			

 			<!-- Delete form -->
 			<form action="b_details.php" method="POST">
 			</form>

 		<?php else: ?>

 			<h5>No such bill exist!</h5>
 			
 		<?php endif; ?>
 	</div>

 	<?php include('templates/footer.php'); ?>
 
 </html>