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

	echo "User ID: $usersId<br>";
	echo "First Name: $firstName<br>";
	echo "Address: $address <br>";
	echo "Email: $email <br>";
	echo "Contact Number: $contactNumber<br>";
	echo "Company: $company<br>";
	echo "Username: $userName<br>";
	echo "Status: $status";


?>