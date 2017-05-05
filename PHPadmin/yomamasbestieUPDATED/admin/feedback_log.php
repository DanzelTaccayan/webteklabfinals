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
		$feedbacks = "Select recName, senderName, content from feedback JOIN recipient JOIN Sender";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($feedbacksQ)){
			echo "<tr><td>" . $row['senderName'] . "</td>";
			echo "<td>" . $row['recName'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
		}
		echo "</tr>";

	}else{
		$feedbacks = "Select content, CONCAT(firstname, middlename, lastname) AS senderName from feedback natural join user_details where idUser = sender";
		$feedbacks2 = "Select content, CONCAT(firstname, middlename, lastname) AS recName from feedback natural join user_details where idUser = recepient";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		$feedbacksQ2 = mysqli_query($conn, $feedbacks2) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($feedbacksQ)){
			$row2 = mysqli_fetch_array($feedbacksQ2);
			echo "<tr><td>" . $row['senderName'] . "</td>";
					echo "<td>" . $row2['recName'] . "</td>";
					echo "<td>" . $row2['content'] . "</td>";

		}
		echo "</tr>";

	}	

	?>
</table>
<a href="../home.php">Home</a>
</body>
</html>