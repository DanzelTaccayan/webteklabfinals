<?php
include '/shared/connection.php';
include '/shared/auth.php';
$transactions = "SELECT * from transaction order by transaction_id desc;";
$transactions_result = mysqli_query($conn, $transactions) or die(mysqli_error($conn));

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
  <a href="./admin/manage_users.php"> Manage Users </a> |
  <a href="./admin/users.php"> Users</a> |
  <a href="./admin/feedback_log.php"> View feedbacks </a> |
  <a href="./admin/viewRequests.php"> View Requests </a>
</nav>
<h2> Transactions </h2>
<table border=1>
<tr>
	<th> Service Provider </th>
	<th> Customer </th>
	<th> Status </th>
	<th> Action </th>
</tr>
	<?php
		while($transaction_arr = mysqli_fetch_array($transactions_result)){
			//sp
			$sp_num = $transaction_arr['sp_id'];
			$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
			$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
			$sp_arr = mysqli_fetch_array($nameSp_result);
			var_dump($sp_arr);
			//customer
			$cust_num = $transaction_arr['cust_id'];
			$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
			$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
			$cust_arr = mysqli_fetch_array($nameCust_result);


			echo "<tr><td>" . $sp_arr['name'] . "</td>";
			echo "<td>" . $cust_arr['name'] . "</td>";
			echo "<td>" . $transaction_arr['transaction_status'] . "</td>";
			echo "<td><a href='#walapa'> View Details </a></td></tr>";
		}
	?>

</table>



</body>
</html>