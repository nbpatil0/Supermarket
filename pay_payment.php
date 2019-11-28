<?php 

	include('config/db_connect_admin.php');

	// check get request id parameter
	if (isset($_GET['bill_no'])) {

		$billno = mysqli_real_escape_string($connect, $_GET['bill_no']);

		//echo $billno;


		$pay_sql = "CALL totalAmount('$billno');";

		$result = mysqli_query($connect, $pay_sql);

		$czip = mysqli_fetch_row($result);

		$amount1 = $czip[0];

		//echo $amount1;

		mysqli_free_result($result);


	}
	//echo $amount1;

	$customer_id = $amount = $mode = $bill_no = '';
	$errors = array('customer_id' => '', 'amount' => '', 'mode' => '', 'bill_no' => '');

	if (isset($_POST['submit'])) {

		//echo $amount1;

		// check bill_no
		if (empty($_POST['bill_no'])) {
			$errors['bill_no'] = 'Bill no is required <br />';
		} else {
			$bill_no = $_POST['bill_no'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
			// 	$errors['name'] = "Name should is letters and spaces only.";
			// }

		}
	
		// check customer_id
		//check bill_no
		// if (empty($_POST['customer_id'])) {
		// 	$errors['customer_id'] = 'customer_id is required <br />';
		// } else {
		// 	$customer_id = $_POST['customer_id'];
		// 	// if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
		// 	// 	$errors['name'] = "Name should is letters and spaces only.";
		// 	// }

		// }

		// check amount
		if (empty($_POST['amount'])) {
			$errors['amount'] = 'Amount is required <br />';
		} else {
			$amount = $_POST['amount'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $amount)) {
			// 	$errors['amount'] = "amount should is letters and spaces only.";
			// }

		}

		// check mode
		if (empty($_POST['mode'])) {
			$errors['mode'] = 'Mode is required <br />';
		} else {
			$mode = $_POST['mode'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $mode)) {
				$errors['mode'] = "Mode should is letters and spaces only.";
			}

		}

		if (array_filter($errors)) {
			//echo "There are errors in the form";
		} else {

			//$customer_id = mysqli_real_escape_string($connect, $_POST['customer_id']);
			$amount = mysqli_real_escape_string($connect, $_POST['amount']);
			$mode = mysqli_real_escape_string($connect, $_POST['mode']);
			$bill_no = mysqli_real_escape_string($connect, $_POST['bill_no']);
			

			// sql for address
			$sql1 = "SELECT customer_id FROM billing_counter WHERE bill_no = $bill_no";

			$result1 = mysqli_query($connect, $sql1);

			$czip = mysqli_fetch_row($result1);

			$c_zip = $czip[0];

			mysqli_free_result($result1);			

			//get data from db and check
			//if ($customer_id != $c_zip) {
				//success

			$sql2 = "INSERT INTO payment(customer_id,amount,mode,bill_no) VALUES('$c_zip', '$amount', '$mode', '$bill_no')";

			if (!mysqli_query($connect, $sql2)) {
				echo 'query error: ' . mysqli_error($connect);
			}

			// sql to get bill_no
			$sql3 = "SELECT payment_id FROM payment WHERE bill_no = $bill_no";

			$result3 = mysqli_query($connect, $sql3);

			$cid3 = mysqli_fetch_row($result3);

			$p_cid3 = $cid3[0];

			//print_r($cid1);

			mysqli_free_result($result3);			


			header("Location: pay_details2.php?id=$p_cid3");



			// // save to db and check
			// if (mysqli_query($connect, $sql)) {
			// 		//success
			// 		header('Location: pay_details2.php?id=$bill_no');
			// 	} else {
			// 		// error
			// 		echo 'query error: ' . mysqli_error($connect);
			// 	}
			//}

		}

		mysqli_close($connect);

	} // end of POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container darkred-text">
		<h4 class="center">Make Payment</h4>
		<form class="white" action="pay_payment.php" method="POST">

			<!-- <h5 class="center">Bill no : <?php echo htmlspecialchars($_GET['bill_no']); ?></h5> -->

			<label>Bill no</label>
			<input type="number" name="bill_no" value="<?php echo htmlspecialchars($_GET['bill_no']); ?>">
			<div class="red-text"><?php echo $errors['bill_no']; ?></div>
			
			<label>Amount</label>
			<input type="number" name="amount" value="<?php echo htmlspecialchars($amount1) ?>">
			<div class="red-text"><?php echo $errors['amount']; ?></div>
			<label>Mode</label>
			<input type="text" name="mode" value="<?php echo htmlspecialchars($mode) ?>">
			<div class="red-text"><?php echo $errors['mode']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>