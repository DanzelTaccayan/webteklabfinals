<?php
include '/shared/connection.php';
include '/shared/auth.php';

$getId = $_GET['transaction_id'];

$transactions = "SELECT * from transaction where transaction_id = '$getId' order by transaction_id desc";
$transactionsQ = mysqli_query($conn, $transactions) or die(mysqli_error($conn));

if ($transactionsQ) {
	$row = mysqli_fetch_array($transactionsQ,MYSQLI_ASSOC);

	//sp
	$sp_num = $row['sp_id'];
	$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
	$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
	$sp_arr = mysqli_fetch_array($nameSp_result,MYSQLI_ASSOC);
	
	//customer
	$cust_num = $row['cust_id'];
	$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
	$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
	$cust_arr = mysqli_fetch_array($nameCust_result,MYSQLI_ASSOC);
	
	//service name
	$service = "SELECT service_name FROM services inner join transaction on services.service_id = transaction.transaction_id";
	$serviceQ = mysqli_query($conn,$service);
	$service_arr = mysqli_fetch_array($serviceQ,MYSQLI_ASSOC);

	$transactionsId = $row['transaction_id'];
	$status = $row['transaction_status'];
	$serviceProvider = $sp_arr['name'];
	$customer = $cust_arr['name'];
	$service = $service_arr['service_name'];
	$created = $row['created_at'];
	$updated = $row['updated_at'];


	echo "Transaction ID: $transactionsId<br>";
	echo "Service : $service<br>";
	echo "Customer: $customer<br>";
	echo "Service Provider: $serviceProvider<br>";
	echo "status: $status<br>";
	echo "Started: $created<br>";
	echo "Updated: $updated<br>";


}

?>