<?php
include '../shared/connection.php';
include '../shared/auth.php';
if (isset($_POST['searchUser'])) {
	$searchUser = $_POST['searchUser'];
}
			
?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Feedbacks</title>

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
                      <a class="active" href="../admin/feedback_log.php" >
                          <i class="fa fa-book"></i>
                          <span>Feedbacks</span>
                      </a>
                  <li class="sub-menu">
                      <a href="../admin/viewRequests.php" >
                          <i class="fa fa-tasks"></i>
                          <span>View Requests</span>
                      </a>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
        <!-- main content -->
        <section id="main-content">
          <section class="wrapper site-min-height">
<h1> Feedbacks </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>
<table class="table table-hover">
<tr>
	<th> Sender </th>
	<th> Recipient </th>
	<th> Content </th>
</tr>
    
<?php
	
	if (isset($_POST['searchButton'])) {
		$feedbacks = "Select recName, senderName, content from feedback JOIN recipient JOIN Sender";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($feedbacksQ)){
			echo "<tr><td>" . $row['senderName'] . "</td>";
			echo "<td>" . $row['recName'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
		}
		echo "</tr>";

	}else{
		$feedbacks = "Select content, CONCAT(firstname, middlename, lastname) AS senderName from feedback natural join user_details where idUser = sender";
		$feedbacks2 = "Select content, CONCAT(firstname, middlename, lastname) AS recName from feedback natural join user_details where idUser = recepient";
		$feedbacksQ = mysqli_query($conn, $feedbacks) or die(mysqli_error($conn));
		$feedbacksQ2 = mysqli_query($conn, $feedbacks2) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($feedbacksQ)){
			$row2 = mysqli_fetch_array($feedbacksQ2);
			echo "<tr><td>" . $row['senderName'] . "</td>";
					echo "<td>" . $row2['recName'] . "</td>";
					echo "<td>" . $row2['content'] . "</td>";

		}
		echo "</tr>";

	}	

	?>
    
</table>
              <a href="../home.php">Home</a>
            </section>
    </section>
    </section>


</body>
</html>