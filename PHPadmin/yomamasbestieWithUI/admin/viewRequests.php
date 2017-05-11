<?php
include '../shared/connection.php';
include '../shared/auth.php';
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Requests</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <script src="../assets/js/chart-master/Chart.js"></script>

</head>
<body>
       	<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="../dashboard.php" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            
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
              
              	  <p class="centered"><a href="../profile.php"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">BESTIE</h5>
              	  	
                  <li class="mt">
                      <a href="../dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="../admin/manage_users.php" >
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
                      <a href="../admin/users.php" >
                          <i class="fa fa-book"></i>
                          <span>Users</span>
                      </a>
                 
                  <li class="sub-menu">
                      <a href="../admin/feedback_log.php" >
                          <i class="fa fa-book"></i>
                          <span>Feedbacks</span>
                      </a>
                  <li class="sub-menu">
                      <a class="active" href="../admin/viewRequests.php" >
                          <i class="fa fa-tasks"></i>
                          <span>View Requests</span>
                      </a>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
            
             <section id="main-content">
          <section class="wrapper site-min-height">
<h1> Requests </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>
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
		echo "</tr>";


	?>
</table>
<a href="../home.php">Home</a>
                 </section>
            </section>
    </section>
    
           <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <!--script for this page-->
</body>
</html>