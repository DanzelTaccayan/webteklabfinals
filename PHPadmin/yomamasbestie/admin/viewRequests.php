<?php
include '../shared/connection.php';
include '../shared/auth.php';
			
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
	</select>
	<input type="submit" name="requestSearchBtn" value="Search">
</form>
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
			}else if($_POST['requestSearch'] == 'reject'){
				$query = "Select * from request where status = 'reject'";
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
			}else if($_POST['requestSearch'] == 'pending'){
				$query = "Select * from request where status = 'pending'";
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
			}

		}else{
			$query = "Select * from request";
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
		}
		
		echo "</tr>";


	?>
</table>

</body>
</html>