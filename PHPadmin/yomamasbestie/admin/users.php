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
	<title>Users</title>
</head>
<body>
<h1> Users </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>
<table border="1">
<tr>
	<th> Username </th>
	<th> User Type </th>
	<th> Name of User </th>
	<th> Company </th>
	<th> Action </th>
</tr>
<?php
	
	if (isset($_POST['searchButton'])) {
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and status='active' and (username like '%".$searchUser."%' or concat(firstname, ' ', middlename, ' ', lastname) like '%".$searchUser."%' or company like '%".$searchUser."%');";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));
		
		while($user_arr = mysqli_fetch_array($user_result)){
			echo "<tr><td>" . $user_arr['username'] . "</td>";
			
			if($user_arr['UserType'] == 'SP'){
				echo "<td> Service Provider </td>";
			}else if($user_arr['UserType'] == 'customer'){
				echo "<td> Customer </td>";
			}
			echo "<td>" . $user_arr['name'] . "</td>";			
			echo "<td>" . $user_arr['company'] . "</td>";
	        echo "<form method='POST' action='manage_users.php'>";
	        echo "<td><a href='view_profile.php?idUsers=". $user_arr['idUsers'] . "'>View Details </a></td>";
			echo "</form>";
		}
		echo "</tr>";

	}else{
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and status='active';";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));

		while($user_arr = mysqli_fetch_array($user_result)){
			echo "<tr><td>" . $user_arr['username'] . "</td>";
			if($user_arr['UserType'] == 'SP'){
				echo "<td> Service Provider </td>";
			}else if($user_arr['UserType'] == 'customer'){
				echo "<td> Customer </td>";
			}
			echo "<td>" . $user_arr['name'] . "</td>";
			echo "<td>" . $user_arr['company'] . "</td>";
	        echo "<form method='POST' action='manage_users.php'>";
	        echo "<td><a href='view_profile.php?idUsers=". $user_arr['idUsers'] . "'>View Details </a></td>";
			echo "</form>";
		}
		echo "</tr>";
	}	

	?>


</table>

<a href="../home.php">Home</a>
</body>
</html>