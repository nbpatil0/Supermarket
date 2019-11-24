<!DOCTYPE html>
<html>
<head>
	<title>Test the column</title>
</head>
<body>

	<div class="container">
		
		<?php 
		$items = ['a','b','c','d'];
		foreach ($items as $item) {
			echo '<div>';
			echo "$item";
			echo '</div>';
			# code...
		}
		 ?>

	</div>

</body>
</html>