<?php 

	//PDO or MySQLI to connect

	$connect = mysqli_connect('localhost', 'admin', 'adminpass', 'supermarketdb');

	// check connection

	if (!$connect) {
		echo "Connection error: " . msqli_connect_error();
	}

 ?>