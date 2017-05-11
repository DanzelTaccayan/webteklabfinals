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
  <a href="./admin/viewRequests.php"> View Requests </a> |
  <a href="./admin/transactions.php"> TRANSACTIONS (DITO NA) </a>
</nav>

<hr>
<h1>Ratings</h1>

<?php 
$spRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) AS evaluatee, AVG(rating) as rating FROM webtekfinals.user_details ud JOIN rating r ON ud.idUser = r.evaluatee WHERE UserType = 'SP' GROUP BY idUser ORDER BY 2 desc limit 10";
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

$custRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) AS evaluatee, AVG(rating) as rating FROM webtekfinals.user_details ud JOIN rating r ON ud.idUser = r.evaluatee WHERE UserType = 'customer' GROUP BY idUser ORDER BY rating desc limit 10";
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
