<?php 

	include('config/db_connect_admin.php');

	$category = $type = '';
	$errors = array('category' => '', 'type' => '');

	if (isset($_POST['submit'])) {

		// check category
		if (empty($_POST['category'])) {
			$errors['category'] = 'A category is required. <br />';
		} else {
			$category = $_POST['category'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $category)) {
				$errors['category'] = "Category should is letters and spaces only.";
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

		if (array_filter($errors)) {
			//echo "There are errors in the form";
		} else {

			$category = mysqli_real_escape_string($connect, $_POST['category']);
			$type = mysqli_real_escape_string($connect, $_POST['type']);

			// create sql
			$sql = "INSERT INTO product_shelves(category,type) VALUES('$category', '$type')";

			// save to db and check
			if (mysqli_query($connect, $sql)) {
				//success
				header('Location: ps_index.php');

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
		<h4 class="center">Add Product Shelves</h4>
		<form class="white" action="ps_product_shelves.php" method="POST">

			<label>Category: </label>
			<input type="text" name="category" value="<?php echo htmlspecialchars($category) ?>">
			<div class="red-text"><?php echo $errors['category']; ?></div>
			<label>Type: </label>
			<input type="text" name="type" value="<?php echo htmlspecialchars($type) ?>">
			<div class="red-text"><?php echo $errors['type']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templets/footer.php'); ?>

</html>