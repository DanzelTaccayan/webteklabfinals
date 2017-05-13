<?php
include '../shared/connection.php';
include '../shared/auth.php';
$checker = "SELECT * FROM request";
$checker_r=mysqli_query($conn, $checker);			
?>			

<!DOCTYPE html>
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
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
             <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Bestie Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                </ul>
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
              	  <h5 class="centered">BESTIE</h5>
              	  	
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
                      <a class="active" href="viewRequests.php" >
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
            <!-- side bar ends here -->
            
             <section id="main-content">
          <section class="wrapper site-min-height">
<h1> Requests </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
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
					echo "<table class='table table-hover'>";
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
					echo "<table class='table table-hover'>";
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
					echo "<table class='table table-hover'>";
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
					echo "<table class='table table-hover'>";
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

                 </section>
            </section>
    </section>
    
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