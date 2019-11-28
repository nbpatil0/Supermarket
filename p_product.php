<?php 

	include('config/db_connect_admin.php');

	$name = $type = $price = $quantity = $category = '';
	$errors = array('name' => '', 'type' => '', 'price' => '', 'quantity' => '', 'category' => '');

	if (isset($_POST['submit'])) {
	
		// check name
		if (empty($_POST['name'])) {
			$errors['name'] = 'Name is required <br />';
		} else {
			$name = $_POST['name'];
			if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
				$errors['name'] = "Name should is letters and spaces only.";
			}

		}

		// check type
		if (empty($_POST['type'])) {
			$errors['type'] = 'A type is required <br />';
		} else {
			$type = $_POST['type'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $type)) {
				$errors['type'] = "Type should is letters and spaces only.";
			}
		}

		// check category
		if (empty($_POST['category'])) {
			$errors['category'] = 'Category is required <br />';
		} else {
			$category = $_POST['category'];
			if (!preg_match('/^[a-zA-Z0-9\s]+$/', $category)) {
				$errors['category'] = "Category should is letters and spaces only.";
			}

		}

		// check price
		if (empty($_POST['price'])) {
			$errors['price'] = 'Price is required <br />';
		} else {
			$price = $_POST['price'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $price)) {
			// 	$errors['price'] = "price should is letters and spaces only.";
			// }
		}

		// check quantity
		if (empty($_POST['quantity'])) {
			$errors['quantity'] = 'Quantity is required <br />';
		} else {
			$quantity = $_POST['quantity'];
			// if (!preg_match('/^[a-zA-Z\s]+$/', $price)) {
			// 	$errors['price'] = "price should is letters and spaces only.";
			// }
		}

		if (array_filter($errors)) {
			//echo "There are errors in the form";
		} else {

			$name = mysqli_real_escape_string($connect, $_POST['name']);
			$type = mysqli_real_escape_string($connect, $_POST['type']);
			$category = mysqli_real_escape_string($connect, $_POST['category']);
			$price = mysqli_real_escape_string($connect, $_POST['price']);
			$quantity = mysqli_real_escape_string($connect, $_POST['quantity']);

			// sql for P_NAME
			$sql0 = "SELECT name FROM p_name WHERE name = '$name'";

			$result0 = mysqli_query($connect, $sql0);

			print_r($result0);

			$pnid = mysqli_fetch_row($result0);

			print_r($pnid);

			$p_nid = $pnid[0];


			mysqli_free_result($result0);			

			//get data from db and check
			if ($name != $p_nid) {
				//success
				$sql1 = "INSERT INTO p_name(name,price,quantity) VALUES('$name', '$price', '$quantity')";
				if (!mysqli_query($connect, $sql1)) {
					echo 'query error: ' . mysqli_error($connect);
				}
			}

			// sql for product_shelves
			$sql2 = "SELECT type FROM product_shelves WHERE type = '$type'";

			$result2 = mysqli_query($connect, $sql2);

			$pstype = mysqli_fetch_row($result2);

			$ps_type = $pstype[0];

			//print_r($pstype);

			mysqli_free_result($result2);			

			//get data from db and check
			if ($type != $ps_type) {
				//success
				$sql3 = "INSERT INTO product_shelves(type,category) VALUES('$type', '$category')";
				if (!mysqli_query($connect, $sql3)) {
					echo 'query error: ' . mysqli_error($connect);
				}
			}

			// sql for P_NAME
			$sql4 = "SELECT name_id FROM p_name WHERE name = '$name'";

			$result4 = mysqli_query($connect, $sql4);

			$pnid4 = mysqli_fetch_row($result4);

			$name_id = $pnid4[0];

			//print_r($pnid4);

			// create sql
			$sql5 = "INSERT INTO product(name_id,type) VALUES('$name_id', '$type')";

			// save to db and check
			if (mysqli_query($connect, $sql5)) {
				//success
				header('Location: p_index.php');

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
		<h4 class="center">Add Product</h4>
		<form class="white" action="p_product.php" method="POST">

			<label>Name </label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>
			<label>Type: </label>
			<input type="text" name="type" value="<?php echo htmlspecialchars($type) ?>">
			<div class="red-text"><?php echo $errors['type']; ?></div>
			<label>Category: </label>
			<input type="text" name="category" value="<?php echo htmlspecialchars($category) ?>">
			<div class="red-text"><?php echo $errors['category']; ?></div>
			<label>Price (in Rs. only)</label>
			<input type="number" name="price" value="<?php echo htmlspecialchars($price) ?>">
			<div class="red-text"><?php echo $errors['price']; ?></div>
			<label>Quantity </label>
			<input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity) ?>">
			<div class="red-text"><?php echo $errors['quantity']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>