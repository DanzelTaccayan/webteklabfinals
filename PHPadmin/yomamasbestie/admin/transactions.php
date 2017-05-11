<?php
include '../shared/connection.php';
include '../shared/auth.php';
$transactions = "SELECT * from transaction order by transaction_id desc;";
$transactions_result = mysqli_query($conn, $transactions) or die(mysqli_error($conn));


?>

<!DOCTYPE html>
<html>
<head>
	<title>Transactions</title>
</head>
<body>
<h1> Transactions </h1>
<a href='../home.php'> Back to Home </a>
<form id = 'searchTransaction' method='POST'>
	<select name = 'statusTransac'>
		<option value='all'> All Transactions </option>
		<option value='on-going'> On Going </option>
		<option value='done'> Done </option>
	</select>
	<input type='submit' name='searchTrans' value='Search'> 
</form>
<table border="1">
<tr>
	<th> Service Provider </th>
	<th> Customer </th>
	<th> Status </th>
	<th> Action </th>
</tr>
<?php
		if(isset($_POST['searchTrans'])){
			if($_POST['statusTransac'] == 'all'){
				while($transaction_arr = mysqli_fetch_array($transactions_result)){
				//sp
				$sp_num = $transaction_arr['sp_id'];
				$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
				$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
				$sp_arr = mysqli_fetch_array($nameSp_result);
				//customer
				$cust_num = $transaction_arr['cust_id'];
				$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
				$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
				$cust_arr = mysqli_fetch_array($nameCust_result);


				echo "<tr><td>" . $sp_arr['name'] . "</td>";
				echo "<td>" . $cust_arr['name'] . "</td>";
				echo "<td>" . $transaction_arr['transaction_status'] . "</td>";
				echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['transaction_id'] . "'>View Details </a></tr>";
				}
			}else if($_POST['statusTransac'] == 'on-going'){
				$newtransac = "SELECT * from transaction where transaction_status = 'ongoing' order by transaction_id desc;";
				$newtransac_result = mysqli_query($conn, $newtransac);
				while($newtransac_array = mysqli_fetch_array($newtransac_result)){
					//sp
					$sp_num = $newtransac_array['sp_id'];
					$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
					$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
					$sp_arr = mysqli_fetch_array($nameSp_result);
					//customer
					$cust_num = $newtransac_array['cust_id'];
					$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
					$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
					$cust_arr = mysqli_fetch_array($nameCust_result);


					echo "<tr><td>" . $sp_arr['name'] . "</td>";
					echo "<td>" . $cust_arr['name'] . "</td>";
					echo "<td>" . $newtransac_array['transaction_status'] . "</td>";
					echo "<td><a href='view_transaction.php?transaction_id=". $newtransac_array['transaction_id'] . "'>View Details </a></tr>";
				}
			}else if($_POST['statusTransac'] == 'done'){
				$newtransac_done = "SELECT * from transaction where transaction_status = 'done' order by transaction_id desc;";
				$newtransac_done_result = mysqli_query($conn, $newtransac_done);
				while($new_transac_done_array = mysqli_fetch_array($newtransac_done_result)){
					//sp
					$sp_num = $new_transac_done_array['sp_id'];
					$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
					$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
					$sp_arr = mysqli_fetch_array($nameSp_result);
					//customer
					$cust_num = $new_transac_done_array['cust_id'];
					$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
					$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
					$cust_arr = mysqli_fetch_array($nameCust_result);


					echo "<tr><td>" . $sp_arr['name'] . "</td>";
					echo "<td>" . $cust_arr['name'] . "</td>";
					echo "<td>" . $new_transac_done_array['transaction_status'] . "</td>";
					echo "<td><a href='view_transaction.php?transaction_id=". $new_transac_done_array['transaction_id'] . "'>View Details </a></tr>";
				}
			}
		}else{
			while($transaction_arr = mysqli_fetch_array($transactions_result)){
			//sp
			$sp_num = $transaction_arr['sp_id'];
			$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
			$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
			$sp_arr = mysqli_fetch_array($nameSp_result);
			//customer
			$cust_num = $transaction_arr['cust_id'];
			$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
			$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
			$cust_arr = mysqli_fetch_array($nameCust_result);


			echo "<tr><td>" . $sp_arr['name'] . "</td>";
			echo "<td>" . $cust_arr['name'] . "</td>";
			echo "<td>" . $transaction_arr['transaction_status'] . "</td>";
			echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['transaction_id'] . "'>View Details </a></tr>";

			}
		}


		
	?>

</table>

</body>
</html>