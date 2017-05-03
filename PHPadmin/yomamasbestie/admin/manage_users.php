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
	<title>Manage Users</title>
</head>
<body>
<h1> Manage Users </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>
<table border="1">
<tr>
	<th> Username </th>
	<th> Account Status </th>
	<th> User Type </th>
	<th> Name of User </th>
	<th> Address </th>
	<th> Email </th>
	<th> Conctact Number </th>
	<th> Company </th>
	<th> Action </th>
</tr>
<?php
	
	if (isset($_POST['searchButton'])) {
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and (username like '%".$searchUser."%' or status like '%".$searchUser."%' or UserType like '%".$searchUser."%' or concat(firstname, ' ', middlename, ' ', lastname) like '%".$searchUser."%' or company like '%".$searchUser."%');";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));
		
		while($user_arr = mysqli_fetch_array($user_result)){
			echo "<tr><td>" . $user_arr['username'] . "</td>";
			echo "<td>" . $user_arr['status'] . "</td>";
			if($user_arr['UserType'] == 'SP'){
				echo "<td> Service Provider </td>";
			}else if($user_arr['UserType'] == 'customer'){
				echo "<td> Customer </td>";
			}
			echo "<td>" . $user_arr['name'] . "</td>";
			echo "<td>" . $user_arr['address'] . "</td>";
			echo "<td>" . $user_arr['email'] . "</td>";
			echo "<td>" . $user_arr['contactnumber'] . "</td>";
			echo "<td>" . $user_arr['company'] . "</td>";
	        echo "<form method='POST' action='manage_users.php'>";
	        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button></td>";
	        echo "<td><button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Disable</button></td>";
			echo "</form>";
		}
		echo "</tr>";

	}else{
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin';";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));

		while($user_arr = mysqli_fetch_array($user_result)){
			echo "<tr><td>" . $user_arr['username'] . "</td>";
			echo "<td>" . $user_arr['status'] . "</td>";
			if($user_arr['UserType'] == 'SP'){
				echo "<td> Service Provider </td>";
			}else if($user_arr['UserType'] == 'customer'){
				echo "<td> Customer </td>";
			}
			echo "<td>" . $user_arr['name'] . "</td>";
			echo "<td>" . $user_arr['address'] . "</td>";
			echo "<td>" . $user_arr['email'] . "</td>";
			echo "<td>" . $user_arr['contactnumber'] . "</td>";
			echo "<td>" . $user_arr['company'] . "</td>";
	        echo "<form method='POST' action='manage_users.php'>";
	        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button></td>";
	        echo "<td><button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Disable</button></td>";
			echo "</form>";
		}
		echo "</tr>";
	}	

	?>


</table>
<?php 
	    if(isset($_POST['activate'])){
                $idActive = $_POST['activate'];
                var_dump($idActive);
                $activateQuery = "UPDATE users SET Status = 'Active' WHERE idUsers = '$idActive'";
                if(mysqli_query($conn, $activateQuery)){
                	header("Location: manage_users.php");
                }
               
            }
            if(isset($_POST['disable'])){
                $idDisable = $_POST['disable'];
                $disableQuery = "UPDATE users SET Status = 'Disabled' WHERE idUsers = '$idDisable' and status = 'Active'";
                if(mysqli_query($conn, $disableQuery)){
                    header("Location: manage_users.php");
                }
            }

?>
<a href="../home.php">Home</a>
</body>
</html>