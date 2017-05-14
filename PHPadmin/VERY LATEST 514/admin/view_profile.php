<?php
include '../shared/connection.php';
include '../shared/auth.php';

$idUsers = $_GET['idUsers'];

if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
//notif number
$notif_num = "SELECT * from notifications where read_at is null";
$notif_num_result = mysqli_query($conn,$notif_num);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Manage Users</title>

 <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    

    <script src="../assets/js/chart-master/Chart.js"></script>
    <link href="../css/placing.css" rel="stylesheet">

  </head>    
        <body>
  <section id="container" >
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
               <li> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style='float:right;'><i class="fa fa-tasks"></i><span class="badge bg-theme"><?php echo mysqli_num_rows($notif_num_result);?></span></button></li>
                    <!-- settings end -->
             
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
           <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.php"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  	
                  <li class="mt">
                      <a href="../dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="manage_users.php" >
                          <i class="fa fa-desktop"></i>
                          <span>Manage Users</span>
                      </a>
<!--
                      <ul class="sub">
                          <li><a  href="general.php">General</a></li>
                          <li><a  href="buttons.php">Buttons</a></li>
                          <li><a  href="panels.php">Panels</a></li>
                      </ul>
-->
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="users.php" >
                          <i class="fa fa-book"></i>
                          <span>Users</span>
                      </a>
                     <li class="sub-menu">
                      <a href="viewRequests.php" >
                          <i class="fa fa-tasks"></i>
                          <span>View Requests</span>
                      </a>
                    <li class="sub-menu">
                        <a href="transactions.php">
                            <i class="fa fa-tasks"></i>
                            <span>View Transactions</span>
                        </a>
                  <li class="sub-menu">
                      <a href="feedback_log.php" >
                          <i class="fa fa-book"></i>
                          <span>Feedbacks</span>
                      </a>
              
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
     <!-- main content -->
     <section id="main-content">
          <section class="wrapper site-min-height">
          	<div class="row mt">
          		<div class="col-lg-12">  

<?php

$userDetails = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where idUsers = '$idUsers'";
$userDetailsQ = mysqli_query($conn, $userDetails) or die(mysqli_error($conn));

if ($userDetailsQ) {
	$row = mysqli_fetch_array($userDetailsQ, MYSQLI_ASSOC);
	$usersId = $row['idUsers'];
	$firstName = $row['name'];
	$address = $row['address'];
	$email = $row['email'];
	$contactNumber = $row['contactnumber'];
	$company = $row['company'];
	$userName = $row['username'];
	$status = $row['status'];

}   echo "<div id='goBlack' class-'container'>";
    echo "<h1>User Details</h1>";
	echo "<p>User ID: $usersId</p>";
	echo "<p>First Name: $firstName</p>";
	echo "<p>Address: $address </p>";
	echo "<p>Email: $email </p>";
	echo "<p>Contact Number: $contactNumber</p>";
	echo "<p>Company: $company</p>";
	echo "<p>Username: $userName</p>";
	echo "<p>Status: $status</p>";
	echo "<p>Request</p>";
    echo "</div>";
?>

            
<table class="table table-hover">
<tr>
	<th> Status </th>
	<th> Requested By </th>
	<th> Requested To </th>
	<th> Service Name </th>
	<th> Request Date </th>
	<th> Updated At </th>

</tr>

<?php
	$query = "Select * from request where requested_by='$idUsers'";
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

?>
</table>
    
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
          $notif = "SELECT * from notifications order by 1 desc limit 8";
          $notif_result = mysqli_query($conn,$notif) or die(mysqli_error($conn));
          while($arr = mysqli_fetch_array($notif_result)){
          	echo "<div><a href='manage_users.php'> ".$arr['data']."</a></div><hr>"; 
          }
            echo "<a href='view_notif.php'>See more</a>";


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

 
    
    
<!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../assets/js/sparkline-chart.js"></script>    
	<script src="../assets/js/zabuto_calendar.js"></script>	
 
</body>
</html>
