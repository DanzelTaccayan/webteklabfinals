<?php
	include '../shared/connection.php';
	include 'auth.php';

	$getId = $_GET['transaction_id'];

	$transactions = "SELECT * from transaction where transaction_id = '$getId' order by transaction_id desc";
	$transactionsQ = mysqli_query($conn, $transactions) or die(mysqli_error($conn));
	//notif number
	$notif_num = "SELECT * from notifications where read_at is null";
	$notif_num_result = mysqli_query($conn,$notif_num);


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
              
              	  <p class="centered"><img src="../assets/img/white.png" class="img-circle" width="60"></p>

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

                  </li>

                  <li class="sub-menu">
                      <a href="users.php" >
                          <i class="fa fa-book"></i>
                          <span>Users</span>
                      </a>
                     <li class="sub-menu">
                      <a href="viewRequests.php" >
                          <i class="fa fa-tasks"></i>
                          <span>View Requests</span>
                      </a>
                    <li class="sub-menu">
                        <a class="active" href="transactions.php">
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
       <section id="main-content">
          <section class="wrapper site-min-height">
          	<div class="row mt">
          		<div class="col-lg-12">  
      <?php
    echo "<div id='goBlack' class='container'>";
    echo "<h3>Details of the transaction between the $customer and the $serviceProvider</h3>";    
	echo "<p>Transaction ID: $transactionsId</p>";
	echo "<p>Service : $service</p>";
	echo "<p>Customer: $customer</p>";
	echo "<p>Service Provider: $serviceProvider</p>";
	echo "<p>status: $status</p>";
	echo "<p>Started: $created</p>";
	echo "<p>Updated: $updated</p>";
	echo "</div>";

}

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
          $notif = "SELECT * from notifications order by 1 desc limit 8";
          $notif_result = mysqli_query($conn,$notif) or die(mysqli_error($conn));
          while($arr = mysqli_fetch_array($notif_result)){
          	echo "<div><a href='manage_users.php'> ".$arr['data']."</a></div><hr>"; 
          }
            echo "<a href='view_notif.php'>See more</a>";

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