<?php
include '../shared/connection.php';
include '../shared/auth.php';

$idUsers = $_GET['idUsers'];

if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$userDetails = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where idUsers = '$idUsers'";
$userDetailsQ = mysqli_query($conn, $userDetails) or die(mysqli_error($conn));

if ($userDetailsQ) {
	$row = mysqli_fetch_array($userDetailsQ, MYSQLI_ASSOC);
	$usersId = $row['idUsers'];
	$firstName = $row['name'];
	$address = $row['address'];
	$email = $row['email'];
	$contactNumber = $row['contactnumber'];
	$company = $row['company'];
	$userName = $row['username'];
	$status = $row['status'];

}
	
	echo "<h1>User Details</h1>";
	echo "User ID: $usersId<br>";
	echo "First Name: $firstName<br>";
	echo "Address: $address <br>";
	echo "Email: $email <br>";
	echo "Contact Number: $contactNumber<br>";
	echo "Company: $company<br>";
	echo "Username: $userName<br>";
	echo "Status: $status <br><br>";
	echo "<h2>Request</h2>";
?>
<html>
<head></head>
<body>
<table border="1">
<tr>
	<th> Status </th>
	<th> Requested By </th>
	<th> Requested To </th>
	<th> Service Name </th>
	<th> Request Date </th>
	<th> Updated At </th>

</tr>

<?php
	$query = "Select * from request where requested_by='$idUsers'";
	$serviceQuery = "Select service_name from request natural join services order by request_date";
	$reqByQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqBy from user_details join request where idUser = requested_by ORDER BY request_date";
	$reqToQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqTo from user_details join request where idUser = requested_to ORDER BY request_date";

	$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$resultServiceQ = mysqli_query($conn, $serviceQuery) or die(mysqli_error($conn));
	$resultReqByQ = mysqli_query($conn, $reqByQuery) or die(mysqli_error($conn));
	$resultReqToQ = mysqli_query($conn, $reqToQuery) or die(mysqli_error($conn));

	while($row = mysqli_fetch_array($resultQ)){
			$serviceRow = mysqli_fetch_array($resultServiceQ);
			$reqByRow = mysqli_fetch_array($resultReqByQ);
			$reqToRow = mysqli_fetch_array($resultReqToQ);

		echo "<tr><td>" . $row['status'] . "</td>";
				echo "<td>" . $reqByRow['reqBy'] . "</td>";
				echo "<td>" . $reqToRow['reqTo'] . "</td>";
				echo "<td>" . $serviceRow['service_name'] . "</td>";
				echo "<td>" . $row['request_date'] . "</td>";
				echo "<td>" . $row['updated_at'] . "</td>";
	}

?>
</table>
</body>
</html>