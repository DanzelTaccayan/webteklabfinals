<?php
include '../shared/connection.php';
include '../shared/auth.php';
$checker = "SELECT * FROM request";
$checker_r=mysqli_query($conn, $checker);			
?>
<!DOCTYPE html>
<html>
<head>
	<title>Requests</title>
</head>
<body>
<h1> Requests </h1>
<a href="../home.php">Home</a>
<form method="POST">
	<select id = 'request' name='requestSearch'>
		<option value = 'all'> All Requests </option>
		<option value = 'reject'> Rejected Requests </option>
		<option value = 'pending'> Pending Requests </option>
		<option value = 'approve'> Approved Requets </option>
	</select>
	<input type="submit" name="requestSearchBtn" value="Search">
</form>

		
	
<?php



if(isset($_POST['requestSearchBtn'])){
			if($_POST['requestSearch'] == 'all'){

				$query = "Select * from request";
				$serviceQuery = "Select service_name from request natural join services order by request_date";
				$reqByQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqBy from user_details join request where idUser = requested_by ORDER BY request_date";
				$reqToQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqTo from user_details join request where idUser = requested_to ORDER BY request_date";
				

				$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$resultServiceQ = mysqli_query($conn, $serviceQuery) or die(mysqli_error($conn));
				$resultReqByQ = mysqli_query($conn, $reqByQuery) or die(mysqli_error($conn));
				$resultReqToQ = mysqli_query($conn, $reqToQuery) or die(mysqli_error($conn));
				//pag may laman
				if(mysqli_num_rows($resultServiceQ) !=0){
					echo "<table border='1'>";
					echo "<tr>";
					echo "<th> Status </th>";
					echo "<th> Requested By </th>";
					echo "<th> Requested To </th>";
					echo "<th> Service Name </th>";
					echo "<th> Request Date </th>";
					echo "<th> Updated At </th>";
					echo "</tr>";

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
				}else{
					echo "<h1> No Requests </h1>";
				}
				
			}else if($_POST['requestSearch'] == 'reject'){
				$query = "Select * from request where status = 'reject'";
				$serviceQuery = "Select service_name from request natural join services order by request_date";
				$reqByQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqBy from user_details join request where idUser = requested_by ORDER BY request_date";
				$reqToQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqTo from user_details join request where idUser = requested_to ORDER BY request_date";
				
				$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$resultServiceQ = mysqli_query($conn, $serviceQuery) or die(mysqli_error($conn));
				$resultReqByQ = mysqli_query($conn, $reqByQuery) or die(mysqli_error($conn));
				$resultReqToQ = mysqli_query($conn, $reqToQuery) or die(mysqli_error($conn));
				if(mysqli_num_rows($resultQ) !=0){
					echo "<table border='1'>";
					echo "<tr>";
					echo "<th> Status </th>";
					echo "<th> Requested By </th>";
					echo "<th> Requested To </th>";
					echo "<th> Service Name </th>";
					echo "<th> Request Date </th>";
					echo "<th> Updated At </th>";
					echo "</tr>";					
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

				}else{
					echo "<h1> No Rejected Request </h1>";
				}
				
			}else if($_POST['requestSearch'] == 'pending'){
				$query = "Select * from request where status = 'pending'";
				$serviceQuery = "Select service_name from request natural join services order by request_date";
				$reqByQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqBy from user_details join request where idUser = requested_by ORDER BY request_date";
				$reqToQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqTo from user_details join request where idUser = requested_to ORDER BY request_date";

				$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$resultServiceQ = mysqli_query($conn, $serviceQuery) or die(mysqli_error($conn));
				$resultReqByQ = mysqli_query($conn, $reqByQuery) or die(mysqli_error($conn));
				$resultReqToQ = mysqli_query($conn, $reqToQuery) or die(mysqli_error($conn));
				if(mysqli_num_rows($resultQ) != 0){
					echo "<table border='1'>";
					echo "<tr>";
					echo "<th> Status </th>";
					echo "<th> Requested By </th>";
					echo "<th> Requested To </th>";
					echo "<th> Service Name </th>";
					echo "<th> Request Date </th>";
					echo "<th> Updated At </th>";
					echo "</tr>";
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
				}else{
					echo "<h1> No Pending Requests </h1>";
					
				}
				echo "</tr>";
			}else if($_POST['requestSearch'] == 'approve'){
				$query = "Select * from request where status = 'approve'";
				$serviceQuery = "Select service_name from request natural join services order by request_date";
				$reqByQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqBy from user_details join request where idUser = requested_by ORDER BY request_date";
				$reqToQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqTo from user_details join request where idUser = requested_to ORDER BY request_date";

				$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$resultServiceQ = mysqli_query($conn, $serviceQuery) or die(mysqli_error($conn));
				$resultReqByQ = mysqli_query($conn, $reqByQuery) or die(mysqli_error($conn));
				$resultReqToQ = mysqli_query($conn, $reqToQuery) or die(mysqli_error($conn));
				if(mysqli_num_rows($resultQ) != 0){
					echo "<table border='1'>";
					echo "<tr>";
					echo "<th> Status </th>";
					echo "<th> Requested By </th>";
					echo "<th> Requested To </th>";
					echo "<th> Service Name </th>";
					echo "<th> Request Date </th>";
					echo "<th> Updated At </th>";
					echo "</tr>";
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
				}else{
					echo "<h1> No Approved Requests </h1>";
					
				}
				echo "</tr>";
			}
			
}else{
	if(mysqli_num_rows($checker_r) != 0){
		$query = "Select * from request";
				$serviceQuery = "Select service_name from request natural join services order by request_date";
				$reqByQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqBy from user_details join request where idUser = requested_by ORDER BY request_date";
				$reqToQuery = "Select CONCAT(firstName,' ',middleName,' ',lastName) as reqTo from user_details join request where idUser = requested_to ORDER BY request_date";
				

				$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$resultServiceQ = mysqli_query($conn, $serviceQuery) or die(mysqli_error($conn));
				$resultReqByQ = mysqli_query($conn, $reqByQuery) or die(mysqli_error($conn));
				$resultReqToQ = mysqli_query($conn, $reqToQuery) or die(mysqli_error($conn));
				//pag may laman
				if(mysqli_num_rows($resultServiceQ) !=0){
					echo "<table border='1'>";
					echo "<tr>";
					echo "<th> Status </th>";
					echo "<th> Requested By </th>";
					echo "<th> Requested To </th>";
					echo "<th> Service Name </th>";
					echo "<th> Request Date </th>";
					echo "<th> Updated At </th>";
					echo "</tr>";

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
				}else{
					echo "<h1> No Requests </h1>";
				}
	}
	echo "</tr>";
}

	?>
</table>

</body>
</html>