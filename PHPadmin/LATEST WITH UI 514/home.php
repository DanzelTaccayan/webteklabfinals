<?php
include '/shared/connection.php';
include '/shared/auth.php';
$transactions = "SELECT * from transaction order by transaction_id desc;";
$transactions_result = mysqli_query($conn, $transactions) or die(mysqli_error($conn));

//notif number
$notif_num = "SELECT * from notifications where read_at is null";
$notif_num_result = mysqli_query($conn,$notif_num);

?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>HOME</title>
</head>
<body>
<a href='logout.php' style = 'float: right;'> Logout </a>
<h1> Hello, Admin! </h1>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style='float:right;'><img src='./img/notif.png' width='25' height='25'><?php echo mysqli_num_rows($notif_num_result);?></button><br>
<nav>
  <a href="home.php">Home</a> |
  <a href="./admin/manage_users.php"> Manage Users </a> |
  <a href="./admin/users.php"> Users</a> |
  <a href="./admin/feedback_log.php"> View feedbacks </a> |
  <a href="./admin/viewRequests.php"> View Requests </a> |
  <a href="./admin/transactions.php"> TRANSACTIONS (DITO NA) </a>
</nav>

<hr>
<h1>Ratings</h1>

<?php 
$spRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) AS evaluatee,AVG(rating) as rating FROM webtekfinals.user_details JOIN rating  ON idUser = evaluatee WHERE UserType = 'SP' GROUP BY idUser ORDER BY 2 desc";
$result = mysqli_query($conn, $spRating);
?>
<h2>Top Service Providers</h2>
<table>
	<tr>
		<th>Service Provider</th>
		<th>Rating</th>
	</tr>
<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['evaluatee'] . "</td>";
		echo "<td>" . $row['rating'] . "</td></tr>";
	}

echo "</table>";

$custRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) AS evaluatee, AVG(rating) as rating FROM webtekfinals.user_details ud JOIN rating r ON ud.idUser = r.evaluatee WHERE UserType = 'customer' GROUP BY idUser ORDER BY 2 desc limit 10";
$result = mysqli_query($conn, $custRating);
?>
<h2>Top Customers</h2>
<table>
	<tr>
		<th>Customers</th>
		<th>Rating</th>
	</tr>
<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['evaluatee'] . "</td>";
		echo "<td>" . $row['rating'] . "</td></tr>";
	}

	echo "</table>";

$totalUser = "SELECT count(idUser) as TotalUsers from user_details;";
$totalUserQ = mysqli_query($conn, $totalUser);
?>
<h2>Total user</h2>

<?php 
	$totalUserResult = mysqli_fetch_array($totalUserQ);
	echo $totalUserResult['TotalUsers'];

$totalSp = "SELECT count(idUser) as TotalSp from user_details where UserType='SP';";
$totalSpQ = mysqli_query($conn, $totalSp);
?>
<h2>Total Service Provider</h2>

<?php 
	$totalSpResult = mysqli_fetch_array($totalSpQ);
	echo $totalSpResult['TotalSp'];

	//Total Customer
	$totalCust = "SELECT count(idUser) as totalCust from user_details where UserType='customer';";
	$totalCustQ = mysqli_query($conn, $totalCust);

	echo "<h2>Total Customer</h2>";

	$totalCustResult = mysqli_fetch_array($totalCustQ);
	echo $totalCustResult['totalCust'];

	//Total Ongoing transaction
	$totalOngoing = "SELECT count(transaction_id) as totalOngo from transaction where transaction_status='ongoing';";
	$totalOngoingQ = mysqli_query($conn, $totalOngoing);

	echo "<h2>Ongoing Transaction</h2>";

	$totalOngoingResult = mysqli_fetch_array($totalOngoingQ);
	echo $totalOngoingResult['totalOngo'];

?>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Notifications</h4>
        </div>
        <div class="modal-body">
          <?php
          $notif = "SELECT * from notifications order by 1 desc";
          $notif_result = mysqli_query($conn,$notif) or die(mysqli_error($conn));
          while($arr = mysqli_fetch_array($notif_result)){
          	echo "<div><a href='./admin/manage_users.php'> ".$arr['data']."</a></div><hr>"; 
          }
            echo "<a href='./dashboard.php'>Back</a>";

          $update = "UPDATE notifications SET read_at=now() WHERE read_at is null";
          $update_result = mysqli_query($conn, $update) or die(mysqli_error($conn));
           
          ?>
            
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</body>
</html>
