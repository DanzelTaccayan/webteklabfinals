<?php
include '../shared/connection.php';
include '../shared/auth.php';
if (isset($_POST['searchUser'])) {
	$searchUser = $_POST['searchUser'];
}

$sender="create or replace view recipient as
SELECT recepient, CONCAT(firstname, middlename, lastname) AS recName from feedback NATURAL JOIN user_details where idUser= recepient";
$butu="create or replace view sender as SELECT sender, CONCAT(firstname, middlename, lastname) AS senderName from feedback NATURAL JOIN user_details where idUser=sender";

$senderQ = mysqli_query($conn, $sender) ;
$recepientQ = mysqli_query($conn, $butu);
			
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
		$feedbacks = "Select recName, senderName, content from feedback inner join recipient  on  feedback.recepient=recipient.recepient inner JOIN Sender on feedback.sender=sender.sender";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($feedbacksQ)){
						var_dump($row);
			echo "<tr><td>" . $row['senderName'] . "</td>";
			echo "<td>" . $row['recName'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
		}
		echo "</tr>";

	}	

	?>
</table>
<a href="../home.php">Home</a>
</body>
</html>
