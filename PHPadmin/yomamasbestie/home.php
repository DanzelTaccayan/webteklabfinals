<?php
include '/shared/connection.php';
include '/shared/auth.php';
$transaction = "SELECT * from transaction";
$transactionQry = mysqli_query($conn,$transaction) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<body>
<a href='logout.php' style = 'float: right;'> Logout </a>
<h1> Hello, Admin! </h1>
<nav>
  <a href="home.php">Home</a> |
  <a href="./admin/manage_users.php"> Manage registration request</a> |
  <a href="./admin/feedback_log.php"> View feedbacks </a>
</nav><br>
<table border='1'>
<tr>
	<th> Service Provider </th>
	<th> Customer </th>
	<th> Transaction Status </th>
	<th> Action </th>
</tr>
<?php
	while($transactionArr = mysqli_fetch_array($transactionQry)){
		echo "<td>" . $transactionArr['sp_id'] . "</td>";
		echo "<td>" . $transactionArr['cust_id'] . "</td>";
		echo "<td>" . $transactionArr['transaction_status']. "</td>";
		echo "<td> <a href=#parametertomgabes> View Details </a> </td></tr>";
	}

?>

</body>
</html>