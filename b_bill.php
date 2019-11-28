<?php 

	include('config/db_connect_admin.php');

	$customer_id = $employee_id = '';
	$errors = array('customer_id' => '', 'employee_id' => '');

	if (isset($_POST['submit'])) {

		// check customer id
		if (empty($_POST['customer_id'])) {
			$errors['customer_id'] = 'A Customer_id is required. <br />';
		} else {
			$customer_id = $_POST['customer_id'];

			$p_sql = "SELECT customer_id FROM customer WHERE customer_id = $customer_id";

			$result = mysqli_query($connect, $p_sql);

			$cid = mysqli_fetch_row($result);

			$p_cid = $cid[0];

			mysqli_free_result($result);			

			//get data from db and check
			if ($customer_id != $p_cid) {
				//success
				$errors['customer_id'] = "Customer bearing customer id: $customer_id does not exit, Please add the customer first.";
			}		
		}

		// check employee id
		if (empty($_POST['employee_id'])) {
			$errors['employee_id'] = 'A employee_id is required. <br />';
		} else {
			$employee_id = $_POST['employee_id'];

			$e_sql = "SELECT employee_id FROM employee WHERE employee_id = $employee_id";

			$e_result = mysqli_query($connect, $e_sql);

			$eid = mysqli_fetch_row($e_result);

			$e_eid = $eid[0];

			mysqli_free_result($e_result);			

			//get data from db and check
			if ($employee_id != $e_eid) {
				//success
				$errors['employee_id'] = "Employee bearing employee id: $employee_id does not exit, Please add the employee first.";
			}		
		}

		if (array_filter($errors)) {
			//echo "There are errors in the form";

		} else {

			$customer = mysqli_real_escape_string($connect, $_POST['customer_id']);
			$employee = mysqli_real_escape_string($connect, $_POST['employee_id']);

			// create sql
			$sql = "INSERT INTO billing_counter(customer_id,employee_id) VALUES('$customer', '$employee')";

			if (!mysqli_query($connect, $sql)) {
				echo 'query error: ' . mysqli_error($connect);
			}

			date_default_timezone_set('Asia/Calcutta');

			$date1 = date("Y-m-d");


			// sql to get bill_no
			$sql1 = "SELECT bill_no FROM billing_counter WHERE bdate LIKE '$date1%' AND customer_id = $customer AND employee_id = $employee";

			$result1 = mysqli_query($connect, $sql1);

			$cid1 = mysqli_fetch_row($result1);

			$p_cid1 = $cid1[0];

			//print_r($cid1);

			mysqli_free_result($result1);			


			header("Location: b_cart.php?bill_no=$p_cid1&c_id=$customer");


			// //save to db and check
			// if (mysqli_query($connect, $sql)) {
			// 	//success
			// 	header("Location: b_cart.php?id=$customer");

			// } else {
			// 	// error
			// 	echo 'query error: ' . mysqli_error($connect);
			// }
		}

		mysqli_close($connect);

	} // end of POST check


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container darkred-text">
		<h4 class="center">Billing</h4>
		<form class="white" action="b_bill.php" method="POST">
			
			<label>Customer_id: </label>
			<input type="number" name="customer_id" value="<?php echo htmlspecialchars($customer_id) ?>">
			<div class="red-text"><?php echo $errors['customer_id']; ?></div>

			<label>Employee_id: </label>
			<input type="number" name="employee_id" value="<?php echo htmlspecialchars($employee_id) ?>">
			<div class="red-text"><?php echo $errors['employee_id']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>