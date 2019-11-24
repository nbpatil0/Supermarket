<?php 

	// connect to db
	include('config/db_connect_admin.php');

	//write quarry for all customers
	//$c_sql = 'SELECT id,customer_id, action,date  FROM c_log ORDER BY id';

	// make quarry & get result
	//$c_result = mysqli_query($connect, $c_sql);

	//fetch the resulting rows as an array
	//$c_log = mysqli_fetch_all($c_result, MYSQLI_ASSOC);

	//freeing the result from memory
	//mysqli_free_result($c_result);

	// close connection
	mysqli_close($connect);

	#explode function (reffer L28)
	//explode(',', $pizzas[0]['ingredients'])

?>

<!-- <!DOCTYPE html>
<html>
	
	<?php //include('templets/header.php'); ?>

	<link rel="stylesheet" type="text/css" href="login/style1.css">


	<?php //include('templets/footer.php'); ?>

</html> -->


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.brand{
  background: #A0522D !important;  
}
.brand-text{
  color: #FFD700 !important;

}

.brand-logo{
   text-shadow: 4px 4px 8px #000;
   padding: 14px 20px;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
</head>
<body>

	<link rel="stylesheet" type="text/css" href="login/style1.css">


<div class="navbar">
  <!-- <a href="#home">Super market</a> -->
  <!-- <a href="#news">News</a> -->
  <a href="mainpage.php" class="left brand-logo brand-text">  Supermarket    </a>
  <div class="dropdown">
    <button class="dropbtn">Customer 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="c_index.php">Customer Index</a>
      <a href="c_customer.php">Add Customer</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Employee 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="e_index.php">Employee Index</a>
      <a href="e_employee.php">Add Employee</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Product 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="p_index.php">Product Index</a>
      <a href="p_product.php">Add Product</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Shelves 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="ps_index.php">Shelves</a>
      <a href="ps_product_shelves.php">Add Category</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Billing
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      
      <a href="b_index.php">Bills Index</a>
      <a href="b_bill.php">New Billing</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div>

  <div class="dropdown">
    <button class="dropbtn">Payments
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      
      <a href="pay_index.php">Payments Index</a>
      <a href="pay_payments.php">New Payment</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div> 

</div>

<!-- <h3>Dropdown Menu inside a Navigation Bar</h3>
<p>Hover over the "Dropdown" link to see the dropdown menu.</p>
 -->
</body>
</html>
