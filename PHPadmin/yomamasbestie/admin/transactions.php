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

<?php

		$limit = 1;
		$current_page = 1;
		if (isset($_GET['page']) && $_GET['page'] > 0) 
		{
		    $current_page = $_GET['page'];
		}
		$offset = ($current_page * $limit) - $limit;


		$viewCust = "CREATE OR REPLACE VIEW customerName AS
        SELECT 
		idUser, transaction_status as stat, transaction_id as a,
        concat(firstName, ' ', middleName, ' ', lastName) as custName 
   		FROM
        transaction
            inner JOIN
        user_details on idUser=cust_id where UserType = 'customer';";
        
        $viewSp = "CREATE OR REPLACE VIEW serpName AS
		SELECT 
		idUser, transaction_status, transaction_id as b,
        concat(firstName, ' ', middleName, ' ', lastName) as spName 
	    FROM
	        transaction
	            inner JOIN
	        user_details on idUser=sp_id
	    WHERE
        UserType = 'SP';";

        $allTran = "SELECT 
				    stat, custName, spName ,a
					FROM
				    customerName
				        inner JOIN
				    serpName on a=b LIMIT $offset, $limit;";

		$allTranQ = mysqli_query($conn, $allTran); 
        $viewCustQ = mysqli_query($conn, $viewCust);
        $viewSpQ = mysqli_query($conn, $viewSp);

        $totalrequest = mysqli_num_rows($transactions_result);
        $pages = ceil($totalrequest/$limit);

		if(isset($_POST['searchTrans'])){
			if($_POST['statusTransac'] == 'all'){
				if(mysqli_num_rows($transactions_result) != 0){
					echo "<table border='1'>";
					echo  "<tr>";
					echo  "<th> Service Provider </th>";
					echo  "<th> Customer </th>";
					echo  "<th> Status </th>";
					echo  "<th> Action </th>";
					echo  "</tr>";
				while($transaction_arr = mysqli_fetch_array($allTranQ)){
					echo "<tr><td>" . $transaction_arr['custName'] . "</td>";
					echo "<td>" . $transaction_arr['spName'] . "</td>";
					echo "<td>" . $transaction_arr['stat'] . "</td>";
					echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['a'] . "'>View Details </a></tr>";
				}
				}else{
					echo "<h1> No transactions </h1>";
				}
			}else if($_POST['statusTransac'] == 'on-going'){
						
					
					$allTran = "SELECT 
				    stat, custName, spName ,a
					FROM
				    customerName
				        inner JOIN
				    serpName on a=b where stat='ongoing';";
					$allTranQ = mysqli_query($conn, $allTran);   
					if(mysqli_num_rows($transactions_result) != 0){
						echo "<table border='1'>";
						echo  "<tr>";
						echo  "<th> Service Provider </th>";
						echo  "<th> Customer </th>";
						echo  "<th> Status </th>";
						echo  "<th> Action </th>";
						echo  "</tr>";
					while($transaction_arr = mysqli_fetch_array($allTranQ)){
						echo "<tr><td>" . $transaction_arr['custName'] . "</td>";
						echo "<td>" . $transaction_arr['spName'] . "</td>";
						echo "<td>" . $transaction_arr['stat'] . "</td>";
						echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['a'] . "'>View Details </a></tr>";
					}
				}else{
				echo "<h1> No on-going transactions </h1>";
				}

			}else if($_POST['statusTransac'] == 'done'){
				
					$allTran = "SELECT 
				    stat , custName, spName ,a
					FROM
				    customerName
				        inner JOIN
				    serpName on a=b where stat='done';";
					$allTranQ = mysqli_query($conn, $allTran);   
					if(mysqli_num_rows($transactions_result) != 0){
						echo "<table border='1'>";
						echo  "<tr>";
						echo  "<th> Service Provider </th>";
						echo  "<th> Customer </th>";
						echo  "<th> Status </th>";
						echo  "<th> Action </th>";
						echo  "</tr>";
					while($transaction_arr = mysqli_fetch_array($allTranQ)){
						echo "<tr><td>" . $transaction_arr['custName'] . "</td>";
						echo "<td>" . $transaction_arr['spName'] . "</td>";
						echo "<td>" . $transaction_arr['stat'] . "</td>";
						echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['a'] . "'>View Details </a></tr>";
					}
				}else{
					echo "<h1> No transactions </h1>";
				}
			}	
		}else{
			if(mysqli_num_rows($transactions_result) != 0){
					echo "<table border='1'>";
					echo  "<tr>";
					echo  "<th> Service Provider </th>";
					echo  "<th> Customer </th>";
					echo  "<th> Status </th>";
					echo  "<th> Action </th>";
					echo  "</tr>";
				while($transaction_arr = mysqli_fetch_array($allTranQ)){

					echo "<tr><td>" . $transaction_arr['spName'] . "</td>";
					echo "<td>" . $transaction_arr['custName'] . "</td>";
					echo "<td>" . $transaction_arr['stat'] . "</td>";
					echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['a'] . "'>View Details </a></tr>";

				}

			}else{
				echo "<h1> No transactions </h1>";
			}
			
		}


		
	?>
	<ul>
	 <!--  <li><a href="#">1</a></li>
	  <li class="active"><a href="#">2</a></li>
	  <li><a href="#">3</a></li>
	  <li><a href="#">4</a></li>
	  <li><a href="#">5</a></li> -->
	  	<?php
			if($current_page == 1){
				echo "<li class='disabled'><a href='javascipt:void(0)'>&laquo;</a></li>";
			}else{
				echo "<li><a href='transactions.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
			}
			for($var = 1; $var <= $pages; $var++){
				echo "<li><a href='transactions.php?page=" .$var. "'>" .$var."</a></li>";
			}
			if($current_page == $pages){
				echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
			}else{
				$a = $current_page + 1;
				echo "<li><a href='transactions.php?page=" .($current_page + 1). "'>&raquo;</a></li>";
			}
		?>
	</ul>

</table>

</body>
</html>