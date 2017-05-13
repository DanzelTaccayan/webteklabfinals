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
	<a href='../home.php'>Home</a>
<?php
         if (isset($_POST['resetpassword'])) {
				 $idRes = $_POST['resetpassword'];
				 	$newpass = mt_rand(10000000, 9999999999);
					$passwordHash = password_hash($newpass, PASSWORD_DEFAULT);


					$resetQuery = "UPDATE users SET Password = '". $passwordHash ."' WHERE idUsers = '$idRes'";
					$resetQueryResult =mysqli_query($conn, $resetQuery) or die(mysqli_error($conn));
					if($resetQueryResult) {
                $resName = "Select UserName from users where idUsers = '$idRes'";
                $resNameQ = mysqli_query($conn, $resName);
                $resNameResult = mysqli_fetch_array($resNameQ);

					echo "<script>alert('Password successfully reset!'); </script>";
					echo "<h1>Username: <i>". $resNameResult['UserName'] ."</i></h1><h1>Your new password is: <i>". $newpass ."</i></h1><h2>Please change the password immediately.</h2><a href='manage_users.php'>OK</a>";

				}

		         } else {
?>
<h1> Manage Users </h1>

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

$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin';";
$pagination = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' LIMIT $offset, $limit ;";	
$paginationQ = mysqli_query($conn, $pagination) or die(mysqli_error($conn));
$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));

$totalrequest = mysqli_num_rows($user_result);
$pages = ceil($totalrequest/$limit);

	if (isset($_POST['searchButton'])) {
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and (username like '%".$searchUser."%' or status like '%".$searchUser."%' or UserType like '%".$searchUser."%' or concat(firstname, ' ', middlename, ' ', lastname) like '%".$searchUser."%' or company like '%".$searchUser."%');";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));
		if(mysqli_num_rows($user_result) != 0){
			while($user_arr = mysqli_fetch_array($user_result)){
				echo "<table border='1'>";
				echo "<tr>";
				echo "<th> Username </th>";
				echo "<th> Account Status </th>";
				echo "<th> User Type </th>";
				echo "<th> Name of User </th>";
				echo "<th> Address </th>";
				echo "<th> Email </th>";
				echo "<th> Conctact Number </th>";
				echo "<th> Company </th>";
				echo "<th> Action </th>";
				echo "</tr>";
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
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to activate this account?")'>
		        <?php
		        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button>";
		        echo "</form>";
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to deactivate this account?")'>
		        <?php
		        echo "<button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Deactivate</button>";
		        echo "</form>"; 
		        ?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to reset password?")'> <?php
		        echo "<button type ='submit' name='resetpassword' value='".$user_arr['idUsers']."'>Reset Password</button></td>";
				echo "</form>";
			}
			echo "</tr>";
			echo "</table>";
		}else{
			echo "<h1> No User Found! </h1>";
		}
			

		

	}else{
		if(mysqli_num_rows($paginationQ)!=0){
			echo "<table border='1'>";
			echo "<tr>";
			echo "<th> Username </th>";
			echo "<th> Account Status </th>";
			echo "<th> User Type </th>";
			echo "<th> Name of User </th>";
			echo "<th> Address </th>";
			echo "<th> Email </th>";
			echo "<th> Conctact Number </th>";
			echo "<th> Company </th>";
			echo "<th> Action </th>";
			echo "</tr>";
			while($user_arr = mysqli_fetch_array($paginationQ)){
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
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to activate this account?")'>
		        <?php
		        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button>";
		        echo "</form>";
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to deactivate this account?")'>
		        <?php
		        echo "<button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Deactivate</button>";
		        echo "</form>"; 
		        ?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to reset password?")'> <?php
		        echo "<button type ='submit' name='resetpassword' value='".$user_arr['idUsers']."'>Reset Password</button></td>";
				echo "</form>";
			}
		echo "</tr>";
		echo "</table>";
		}else{
			echo "<h1> No User/s Found </h1>";
		}	
		}
}
	?>


</table>

<?php 
	    if(isset($_POST['activate'])){
                $idActive = $_POST['activate'];
                $nameAc = "Select UserName, Status from users where idUsers = '$idActive'";
                $nameAcQ = mysqli_query($conn, $nameAc);
                $nameAcRes = mysqli_fetch_array($nameAcQ);
                $statusAc = $nameAcRes['Status'];

                if ($statusAc == 'Disabled' || $statusAc == 'pending') {
                $activateQuery = "UPDATE users SET Status = 'Active' WHERE idUsers = '$idActive'";
                if(mysqli_query($conn, $activateQuery)){
					echo "<script>alert('The account " .$nameAcRes['UserName']. " has been activated!'); location.href = 'manage_users.php'; </script>";
                }
            } else {
            	echo "<script>alert('The account " .$nameAcRes['UserName']. " is already activated!');</script>";
            }
               
            }
            
            if(isset($_POST['disable'])){
                $idDisable = $_POST['disable'];
                $nameDes = "Select UserName, Status from users where idUsers = '$idDisable'";
                $nameDesQ = mysqli_query($conn, $nameDes);
                $nameDesRes = mysqli_fetch_array($nameDesQ);
                $statusDes = $nameDesRes['Status'];
                
                if ($statusDes == 'Active' || $statusDes == 'pending') {
	                $disableQuery = "UPDATE users SET Status = 'Disabled' WHERE idUsers = '$idDisable'";
		                if(mysqli_query($conn, $disableQuery)){
							echo "<script>alert('The account " .$nameDesRes['UserName']. " has been deactivated!'); location.href = 'manage_users.php'; </script>";
		                }
        	    } else {
			            	echo "<script>alert('The account " .$nameDesRes['UserName']. " is already deactivated!');</script>";

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
						echo "<li><a href='manage_users.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
					}
					for($var = 1; $var <= $pages; $var++){
						echo "<li><a href='manage_users.php?page=" .$var. "'>" .$var."</a></li>";
					}
					if($current_page == $pages){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
					}else{
						echo "<li><a href='manage_users.php?page=" .($current_page + 1). "'>&raquo;</a></li>";
					}
				?>
	</ul>
</body>
</html>