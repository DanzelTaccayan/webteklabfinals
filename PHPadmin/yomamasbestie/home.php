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
			//customer
			$cust_num = $transaction_arr['cust_id'];
			$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
			$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
			$cust_arr = mysqli_fetch_array($nameCust_result);


			echo "<tr><td>" . $sp_arr['name'] . "</td>";
			echo "<td>" . $cust_arr['name'] . "</td>";
			echo "<td>" . $transaction_arr['transaction_status'] . "</td>";
			echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['transaction_id'] . "'>View Details </a></tr>";
		}
	?>

</table>
<hr>
<h1>Ratings</h1>

<?php 
$spRating = "SELECT CONCAT(lastName,', ', firstName,' ', middleName) as evaluatee, AVG(rating) as rating from user_details join rating where idUser = evaluatee and UserType = 'SP' group by evaluatee ORDER BY 2 DESC";
$result = mysqli_query($conn, $spRating);
?>
<h2>Top Service Providers</h2>
<table>
	<tr>
		<th>Service Provider</th>
		<th>Rating</th>
	</tr>
<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['evaluatee'] . "</td>";
		echo "<td>" . $row['rating'] . "</td></tr>";
	}

echo "</table>";

$custRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) as evaluatee, AVG(rating) as rating from user_details join rating where idUser = evaluatee and UserType = 'customer' group by evaluatee ORDER BY 2 DESC";
$result = mysqli_query($conn, $custRating);
?>
<h2>Top Customers</h2>
<table>
	<tr>
		<th>Customers</th>
		<th>Rating</th>
	</tr>
<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['evaluatee'] . "</td>";
		echo "<td>" . $row['rating'] . "</td></tr>";
	}

	echo "</table>";
?>
</body>
</html>
