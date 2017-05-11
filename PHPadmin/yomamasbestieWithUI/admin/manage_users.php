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

    <title>Manage Users</title>

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
    <link href="../css/placing.css" rel="stylesheet">

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
                      <a class="active" href="../admin/manage_users.php" >
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
                      <a href="../admin/viewRequests.php" >
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
<h1> Manage Users </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="ID/Username/Name/Status/company">
	<input type="submit" name="searchButton" value="Search">
</form>
<table class="table table-hover">
<thead class="thead-inverse">
<tr>
	<th> Username </th>
	<th> Account Status </th>
	<th> User Type </th>
	<th> Name of User </th>
	<th> Address </th>
	<th> Email </th>
	<th> Conctact Number </th>
	<th> Company </th>
	<th> Action </th>
</tr>
</thead>
    
    
<?php
	
	if (isset($_POST['searchButton'])) {
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and (username like '%".$searchUser."%' or status like '%".$searchUser."%' or UserType like '%".$searchUser."%' or concat(firstname, ' ', middlename, ' ', lastname) like '%".$searchUser."%' or company like '%".$searchUser."%');";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));
		
		while($user_arr = mysqli_fetch_array($user_result)){
			echo "<tr><td>" . $user_arr['username'] . "</td>";
			echo "<td>" . $user_arr['status'] . "</td>";
			if($user_arr['UserType'] == 'SP'){
				echo "<td> Service Provider </td>";
			}else if($user_arr['UserType'] == 'customer'){
				echo "<td> Customer </td>";
			}
			echo "<td>" . $user_arr['name'] . "</td>";
			echo "<td>" . $user_arr['address'] . "</td>";
			echo "<td>" . $user_arr['email'] . "</td>";
			echo "<td>" . $user_arr['contactnumber'] . "</td>";
			echo "<td>" . $user_arr['company'] . "</td>";
	        echo "<form method='POST' action='manage_users.php'>";
	        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button></td>";
	        echo "<td><button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Disable</button></td>";
			echo "</form>";
		}
		echo "</tr>";

	}else{
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin';";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));

		while($user_arr = mysqli_fetch_array($user_result)){
			echo "<tr><td>" . $user_arr['username'] . "</td>";
			echo "<td>" . $user_arr['status'] . "</td>";
			if($user_arr['UserType'] == 'SP'){
				echo "<td> Service Provider </td>";
			}else if($user_arr['UserType'] == 'customer'){
				echo "<td> Customer </td>";
			}
			echo "<td>" . $user_arr['name'] . "</td>";
			echo "<td>" . $user_arr['address'] . "</td>";
			echo "<td>" . $user_arr['email'] . "</td>";
			echo "<td>" . $user_arr['contactnumber'] . "</td>";
			echo "<td>" . $user_arr['company'] . "</td>";
	        echo "<form method='POST' action='manage_users.php'>";
	        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button></td>";
	        echo "<td><button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Disable</button></td>";
			echo "</form>";
		}
		echo "</tr>";
	}	

	?>


              </table>
            </section>
        </section>
    </section>
<?php 
	    if(isset($_POST['activate'])){
                $idActive = $_POST['activate'];
                var_dump($idActive);
                $activateQuery = "UPDATE users SET Status = 'Active' WHERE idUsers = '$idActive'";
                if(mysqli_query($conn, $activateQuery)){
                	header("Location: manage_users.php");
                }
               
            }
            
            if(isset($_POST['disable'])){
                $idDisable = $_POST['disable'];
                $disableQuery = "UPDATE users SET Status = 'Disabled' WHERE idUsers = '$idDisable' and status = 'Active'";
                if(mysqli_query($conn, $disableQuery)){
                    header("Location: manage_users.php");
                }
            }

?>
<a href="../home.php">Home</a>
    
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