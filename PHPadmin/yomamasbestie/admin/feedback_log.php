<?php
include '../shared/connection.php';
include '../shared/auth.php';
if (isset($_POST['searchUser'])) {
	$searchUser = $_POST['searchUser'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Feedbacks</title>
</head>
<body>
<h1> Feedbacks </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>
<table border="1">
<tr>
	<th> Sender </th>
	<th> Recipient </th>
	<th> Content </th>
</tr>
<?php
	
	if (isset($_POST['searchButton'])) {
		$feedbacks = "select * from feedback";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($feedbacksQ)){
			echo "<tr><td>" . $row['sender'] . "</td>";
			echo "<td>" . $row['recepient'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
		}
		echo "</tr>";

	}else{
		$feedbacks = "select * from feedback";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($feedbacksQ)){
			echo "<tr><td>" . $row['sender'] . "</td>";
			echo "<td>" . $row['recepient'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
		}
		echo "</tr>";

	}	

	?>
</table>
<a href="../home.php">Home</a>
</body>
</html>