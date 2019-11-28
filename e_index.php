<?php 

	// connect to db
	include('config/db_connect_admin.php');

	//write quarry for all customers
	$e_sql = 'SELECT employee_id, name, email  FROM employee ORDER BY employee_id';

	// make quarry & get result
	$e_result = mysqli_query($connect, $e_sql);

	//fetch the resulting rows as an array
	$employee = mysqli_fetch_all($e_result, MYSQLI_ASSOC);

	//freeing the result from memory
	mysqli_free_result($e_result);

	// close connection
	mysqli_close($connect);

	#explode function (reffer L28)
	//explode(',', $pizzas[0]['ingredients'])

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center darkred-text">Employees</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($employee as $emp): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!-- <img src="img/Me2.jpg" class="customer"> -->
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($emp['employee_id']); ?></h6>
							<div><?php echo htmlspecialchars($emp['name']); ?></div>
							<div><?php echo htmlspecialchars($emp['email']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="e_details.php?id=<?php echo $emp['employee_id']?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>