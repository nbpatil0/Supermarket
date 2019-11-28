<?php 

	include('config/db_connect_admin.php');

	$name = $email = $pnumber = $city = $district = $state = $zipcode = '';
	$errors = array('name' => '', 'email' => '', 'pnumber' => '', 'city' => '', 'district' => '', 'state' => '', 'zipcode' => '');

	if (isset($_POST['submit'])) {
	
		// check name
		if (empty($_POST['name'])) {
			$errors['name'] = 'Name is required <br />';
		} else {
			$name = $_POST['name'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
				$errors['name'] = "Name should is letters and spaces only.";
			}

		}

		// check email
		if (empty($_POST['email'])) {
			$errors['email'] = 'An email id is required <br />';
		} else {
			$email = $_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = "email must be a valid email address.";
			}
		}

		// check phone number
		if (empty($_POST['pnumber'])) {
			$errors['pnumber'] = 'A phone number is required <br />';
		} else {
			$pnumber = $_POST['pnumber'];
			// if (count($number)!=10) {
			// 	$errors['number'] = "Phone number must be valid.";
			// }
		}

		// check city
		if (empty($_POST['city'])) {
			$errors['city'] = 'City is required <br />';
		} else {
			$city = $_POST['city'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $city)) {
				$errors['city'] = "City should is letters and spaces only.";
			}

		}

		// check district
		if (empty($_POST['district'])) {
			$errors['district'] = 'District is required <br />';
		} else {
			$district = $_POST['district'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $district)) {
				$errors['district'] = "District should is letters and spaces only.";
			}

		}

		// check state
		if (empty($_POST['state'])) {
			$errors['state'] = 'State is required <br />';
		} else {
			$state = $_POST['state'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $state)) {
				$errors['state'] = "State should is letters and spaces only.";
			}

		}

		// check zipcode
		if (empty($_POST['zipcode'])) {
			$errors['zipcode'] = 'Zipcode is required <br />';
		} else {
			$zipcode = $_POST['zipcode'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $zipcode)) {
			// 	$errors['zipcode'] = "zipcode should is letters and spaces only.";
			//}

		}

		if (array_filter($errors)) {
			//echo "There are errors in the form";
		} else {

			$name = mysqli_real_escape_string($connect, $_POST['name']);
			$email = mysqli_real_escape_string($connect, $_POST['email']);
			$pnumber = mysqli_real_escape_string($connect, $_POST['pnumber']);
			$city = mysqli_real_escape_string($connect, $_POST['city']);
			$district = mysqli_real_escape_string($connect, $_POST['district']);
			$state = mysqli_real_escape_string($connect, $_POST['state']);
			$zipcode = mysqli_real_escape_string($connect, $_POST['zipcode']);

			// sql for address
			$sql1 = "SELECT zipcode FROM address WHERE zipcode = $zipcode";

			$result1 = mysqli_query($connect, $sql1);

			$czip = mysqli_fetch_row($result1);

			$c_zip = $czip[0];

			mysqli_free_result($result1);			

			//get data from db and check
			if ($zipcode != $c_zip) {
				//success
				$sql2 = "INSERT INTO address(zipcode,state,district,city) VALUES('$zipcode', '$state', '$district', '$city')";

				if (!mysqli_query($connect, $sql2)) {
					echo 'query error: ' . mysqli_error($connect);
				}
			}

			// create sql
			$sql = "INSERT INTO customer(name,email,phone_no,zipcode) VALUES('$name', '$email', '$pnumber', '$zipcode')";

			// save to db and check
			if (mysqli_query($connect, $sql)) {
				//success
				header('Location: c_index.php');

			} else {
				// error
				echo 'query error: ' . mysqli_error($connect);
			}
		}

	} // end of POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container darkred-text">
		<h4 class="center">Add customer</h4>
		<form class="white" action="c_customer.php" method="POST">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>
			<label>Your email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Phone number</label>
			<input type="number" name="pnumber" value="<?php echo htmlspecialchars($pnumber) ?>">
			<div class="red-text"><?php echo $errors['pnumber']; ?></div>

			<label>City</label>
			<input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>">
			<div class="red-text"><?php echo $errors['city']; ?></div>
			<label>District</label>
			<input type="text" name="district" value="<?php echo htmlspecialchars($district) ?>">
			<div class="red-text"><?php echo $errors['district']; ?></div>
			<label>State</label>
			<input type="text" name="state" value="<?php echo htmlspecialchars($state) ?>">
			<div class="red-text"><?php echo $errors['state']; ?></div>
			<label>Zipcode</label>
			<input type="number" name="zipcode" value="<?php echo htmlspecialchars($zipcode) ?>">
			<div class="red-text"><?php echo $errors['zipcode']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>