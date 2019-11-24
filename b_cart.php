<?php 

	include('config/db_connect_admin.php');

	// date_default_timezone_set('Asia/Calcutta');

	// $date1 = date("Y-m-d");

	$billno = '';

	// check get request id parameter
	if (isset($_GET['id'])) {

		$billno = mysqli_real_escape_string($connect, $_GET['bill_no']);

		// // make sql
		// $b_sql = "SELECT bill_no FROM billing_counter WHERE bdate LIKE '$date1%' AND customer_id = $b_cid";

		// // get query result
		// $b_result = mysqli_query($connect, $b_sql);

		// // fetch result in array format
		// $billno = mysqli_fetch_assoc($b_result);

		// $bill_no = $billno['bill_no'];

		// echo $b_sql;

		// echo $date1;

		// echo($bill_no);

		// mysqli_free_result($b_result);
		// mysqli_close($connect);		
	}
	//echo $billno;

	$model_id = $quantity = $amount = $bill_no = '';
	$errors = array('model_id' => '', 'quantity' => '', 'amount' => '', 'bill_no' => '');


	if (isset($_POST['add_more']) || isset($_POST['make_payment'])) {

		echo $bill_no;

		// check bill_no
		if (empty($_POST['bill_no'])) {
			$errors['bill_no'] = 'Bill no is required <br />';
		} else {
			$bill_no = $_POST['bill_no'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
			// 	$errors['name'] = "Name should is letters and spaces only.";
			// }

		}
	
		// check model_id
		if (empty($_POST['model_id'])) {
			$errors['model_id'] = 'Model_id is required <br />';
		} else {
			$model_id = $_POST['model_id'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
			// 	$errors['name'] = "Name should is letters and spaces only.";
			// }

		}

		// check quantity
		if (empty($_POST['quantity'])) {
			$errors['quantity'] = 'A quantity is required <br />';
		} else {
			$quantity = $_POST['quantity'];
			// if (count($number)!=10) {
			// 	$errors['number'] = "Phone number must be valid.";
			// }
		}

		//$sql0 = "CREATE TRIGGER amount BEFORE INSERT ON cart FOR EACH ROW BEGIN SELECT "

		// check amount
		if (empty($_POST['amount'])) {
			$errors['amount'] = 'Amount is required <br />';
		} else {
			$amount = $_POST['amount'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $zipcode)) {
			// 	$errors['zipcode'] = "zipcode should is letters and spaces only.";
			//}

		}

		if (array_filter($errors)) {
			//echo "There are errors in the form";
		} else {

			$model_id = mysqli_real_escape_string($connect, $_POST['model_id']);
			$quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
			$amount = mysqli_real_escape_string($connect, $_POST['amount']);
			$bill_no = mysqli_real_escape_string($connect, $_POST['bill_no']);		
			

			// create sql
			$sql = "INSERT INTO cart(model_id,quantity,amount,bill_no) VALUES('$model_id', '$quantity', '$amount', '$bill_no')";

			// save to db and check
			if (mysqli_query($connect, $sql)) {
				//success
				if (isset($_POST['add_more'])) {

					header("Location: b_cart.php?bill_no=$bill_no");

				} elseif (isset($_POST['make_payment'])) {

					header("Location: pay_payment.php?bill_no=$bill_no");

				}

			} else {
				// error
				echo 'query error: ' . mysqli_error($connect);
			}
		}

		mysqli_close($connect);

	} // end of POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templets/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add Items</h4>
		<form class="white" action="b_cart.php" method="POST">

			<label>Bill no</label>
			<input type="number" name="bill_no" value="<?php echo htmlspecialchars($_GET['bill_no']); ?>">
			<div class="red-text"><?php echo $errors['bill_no']; ?></div>

			<label>Model Id</label>
			<input type="number" name="model_id" value="<?php echo htmlspecialchars($model_id) ?>">
			<div class="red-text"><?php echo $errors['model_id']; ?></div>

			<label>Quantity </label>
			<input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity) ?>">
			<div class="red-text"><?php echo $errors['quantity']; ?></div>

			<label>Amount (in Rs. only)</label>
			<input type="number" name="amount" value="<?php echo htmlspecialchars($amount) ?>">
			<div class="red-text"><?php echo $errors['amount']; ?></div>
			
			
			<div class="center">
				<input type="submit" name="add_more" value="Add more" class="btn brand z-depth-0">
				<input type="submit" name="make_payment" value="Make Payment" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templets/footer.php'); ?>

</html>