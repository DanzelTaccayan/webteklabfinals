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
<a href="../home.php">Home</a>
<h1> Users </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>

<?php

$limit = 5;
$current_page = 1;
if (isset($_GET['page']) && $_GET['page'] > 0) 
{
    $current_page = $_GET['page'];
}
$offset = ($current_page * $limit) - $limit;

$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and status='active';";
$paginator = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and status='active' LIMIT $offset, $limit;";
$paginatorQ = mysqli_query($conn, $paginator) or die(mysqli_error($conn));
$userResultQ = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));	

$totalrequest = mysqli_num_rows($userResultQ);
$pages = ceil($totalrequest/$limit);

	if (isset($_POST['searchButton'])) {
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and status='active' and (username like '%".$searchUser."%' or concat(firstname, ' ', middlename, ' ', lastname) like '%".$searchUser."%' or company like '%".$searchUser."%');";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($user_result) !=0){
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
			echo "<h1> User not Found! </h1>";
		}
		

	}else{

		if(mysqli_num_rows($paginatorQ) != 0){
			echo "<table border='1'>";
			echo "<tr>";
			echo "<th> Username </th>";
			echo "<th> User Type </th>";
			echo "<th> Name of User </th>";
			echo "<th> Company </th>";
			echo "<th> Action </th>";
			echo "</tr>";
			while($user_arr = mysqli_fetch_array($paginatorQ)){
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
		
	}	

	?>
		<ul class="pagination">
			 <!--  <li><a href="#">1</a></li>
			  <li class="active"><a href="#">2</a></li>
			  <li><a href="#">3</a></li>
			  <li><a href="#">4</a></li>
			  <li><a href="#">5</a></li> -->
				<?php
					if($current_page == 1){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&laquo;</li>";
					}else{
						echo "<li><a href='users.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
					}
					for($var = 1; $var <= $pages; $var++){
						echo "<li><a href='users.php?page=" .$var. "'>" .$var."</a></li>";
					}
					if($current_page == $pages){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
					}else{
						echo "<li><a href='users.php?page=" .($current_page + 1). "'>&raquo;</a></li>";
					}
				?>
			</ul>


</table>


</body>
</html>