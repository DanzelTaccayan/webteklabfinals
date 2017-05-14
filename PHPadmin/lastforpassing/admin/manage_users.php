<?php
include '../shared/connection.php';
include 'auth.php';

//notif number
$notif_num = "SELECT * from notifications where read_at is null";
$notif_num_result = mysqli_query($conn,$notif_num);
    
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
       <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                  <li> <button type="button" id = 'usersnotif' class="btn btn-info" data-toggle="modal" data-target="#myModal" style='float:right;'><i class="fa fa-tasks"></i><span class="badge bg-theme">
                    <?php
                   $notifs = "SELECT * from notifications where notification_type='Admin' and read_at is null";
                   $notifs_result = mysqli_query($conn, $notifs);
                   echo mysqli_num_rows($notifs_result); 
                   ?>
                  </span></button></li>
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
<!--                  <h5 class="centered">Yuki</h5>-->
              	  	
                  <li class="mt">
                      <a href="../dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="manage_users.php" >
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
        
        <section id="main-content">
          <section class="wrapper site-min-height">
              
<?php
         if (isset($_POST['resetpassword'])) {
				 $idRes = $_POST['resetpassword'];
				 	$newpass = mt_rand(10000000, 9999999999);
					$passwordHash = password_hash($newpass, PASSWORD_DEFAULT);


					$resetQuery = "UPDATE users SET Password = '". $passwordHash ."' WHERE idUsers = '$idRes'";
					$resetQueryResult =mysqli_query($conn, $resetQuery) or die(mysqli_error($conn));
					if($resetQueryResult) {
                $resName = "Select UserName from users where idUsers = '$idRes'";
                $resNameQ = mysqli_query($conn, $resName);
                $resNameResult = mysqli_fetch_array($resNameQ);

					echo "<script>alert('Password successfully reset!'); </script>";
					echo "<h1>Username: <i>". $resNameResult['UserName'] ."</i></h1><h1>Your new password is: <i>". $newpass ."</i></h1><h2>Please change the password immediately.</h2><a href='manage_users.php'>OK</a>";

				}

		         } else {
?>
              
              
<h1> Manage Users </h1>
<form method="POST">
	<input type="text" name="searchUser" placeholder="Search box">
	<input type="submit" name="searchButton" value="Search">
</form>
        
<?php
$limit = 5;
$current_page = 1;
if (isset($_GET['page']) && $_GET['page'] > 0) 
{
    $current_page = $_GET['page'];
}
$offset = ($current_page * $limit) - $limit;

$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin';";
$pagination = "select idUsers, username, status, UserType, CONCAT(lastName,', ',firstName,' ',middleName) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' ORDER BY idUser desc LIMIT $offset, $limit ;";	
$paginationQ = mysqli_query($conn, $pagination) or die(mysqli_error($conn));
$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));

$totalrequest = mysqli_num_rows($user_result);
$pages = ceil($totalrequest/$limit);

	if (isset($_POST['searchButton'])) {
		$user_qry = "select idUsers, username, status, UserType, concat(firstname, ' ', middlename, ' ', lastname) as name, address, email, contactnumber, company from users inner join user_details on idUser = idUsers where usertype!='admin' and (username like '%".$searchUser."%' or status like '%".$searchUser."%' or UserType like '%".$searchUser."%' or concat(firstname, ' ', middlename, ' ', lastname) like '%".$searchUser."%' or company like '%".$searchUser."%');";
		$user_result = mysqli_query($conn, $user_qry) or die(mysqli_error($conn));
		if(mysqli_num_rows($user_result) != 0){	
            echo "<table class='table table-hover'>";
				echo "<tr>";
				echo "<th> Username </th>";
				echo "<th> Account Status </th>";
				echo "<th> User Type </th>";
				echo "<th> Name of User </th>";
				echo "<th> Address </th>";
				echo "<th> Email </th>";
				echo "<th> Conctact Number </th>";
				echo "<th> Company </th>";
				echo "<th> Action </th>";
				echo "</tr>";
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
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to activate this account?")'>
		        <?php
		        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button>";
		        echo "</form>";
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to deactivate this account?")'>
		        <?php
		        echo "<button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Deactivate</button>";
		        echo "</form>"; 
		        ?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to reset password?")'> <?php
		        echo "<button type ='submit' name='resetpassword' value='".$user_arr['idUsers']."'>Reset Password</button></td>";
				echo "</form>";
			}
			echo "</tr>";
			echo "</table>";
    echo "<a href='manage_users.php'> See All </a>";

		}else{
			echo "<h1> No User Found! </h1>";
		}
			

		

	}else{
		if(mysqli_num_rows($paginationQ)!=0){
			echo "<table class='table table-hover'>";
			echo "<tr>";
			echo "<th> Username </th>";
			echo "<th> Account Status </th>";
			echo "<th> User Type </th>";
			echo "<th> Name of User </th>";
			echo "<th> Address </th>";
			echo "<th> Email </th>";
			echo "<th> Conctact Number </th>";
			echo "<th> Company </th>";
			echo "<th> Action </th>";
			echo "</tr>";
			while($user_arr = mysqli_fetch_array($paginationQ)){
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
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to activate this account?")'>
		        <?php
		        echo "<td><button type ='submit' name='activate' value='".$user_arr['idUsers']."'>Activate</button>";
		        echo "</form>";
				?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to deactivate this account?")'>
		        <?php
		        echo "<button type ='submit' name='disable' value='".$user_arr['idUsers']."'>Deactivate</button>";
		        echo "</form>"; 
		        ?>
		        <form method= 'post' onsubmit= 'return confirm("Are you sure you want to reset password?")'> <?php
		        echo "<button type ='submit' name='resetpassword' value='".$user_arr['idUsers']."'>Reset Password</button></td>";
				echo "</form>";
			}
		echo "</tr>";
		echo "</table>";
    ?>
    <div class="page">
  <ul class="pagination">
       <!--  <li><a href="#">1</a></li>
        <li class="active"><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li> -->
        <?php
          if($current_page == 1){
            echo "<li class='disabled'><a href='javascipt:void(0)'>&laquo;</li>";
          }else{
            echo "<li><a href='manage_users.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
          }
          for($var = 1; $var <= $pages; $var++){
            echo "<li><a href='manage_users.php?page=" .$var. "'>" .$var."</a></li>";
          }
          if($current_page == $pages){
            echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
          }else{
            echo "<li><a href='manage_users.php?page=" .($current_page + 1). "'>&raquo;</a></li>";
          }

        ?>
  </ul>
    </div>
    <?php

		}else{
                 if ($current_page > $pages) {
            echo "<script> alert('Invalid page!'); window.location = 'manage_users.php';</script>";
          }

			echo "<h1> No User/s Found </h1>";
		}	
		}
}
	?>
              </table>
        
<?php 
	    if(isset($_POST['activate'])){
                $idActive = $_POST['activate'];
                $nameAc = "Select UserName, Status from users where idUsers = '$idActive'";
                $nameAcQ = mysqli_query($conn, $nameAc);
                $nameAcRes = mysqli_fetch_array($nameAcQ);
                $statusAc = $nameAcRes['Status'];

                if ($statusAc == 'Disabled' || $statusAc == 'pending') {
                $activateQuery = "UPDATE users SET Status = 'Active' WHERE idUsers = '$idActive'";
                if(mysqli_query($conn, $activateQuery)){
					echo "<script>alert('The account " .$nameAcRes['UserName']. " has been activated!'); location.href = 'manage_users.php'; </script>";
                }
            } else {
            	echo "<script>alert('The account " .$nameAcRes['UserName']. " is already activated!');</script>";
            }
               
            }
            
            if(isset($_POST['disable'])){
                $idDisable = $_POST['disable'];
                $nameDes = "Select UserName, Status from users where idUsers = '$idDisable'";
                $nameDesQ = mysqli_query($conn, $nameDes);
                $nameDesRes = mysqli_fetch_array($nameDesQ);
                $statusDes = $nameDesRes['Status'];
                
                if ($statusDes == 'Active' || $statusDes == 'pending') {
	                $disableQuery = "UPDATE users SET Status = 'Disabled' WHERE idUsers = '$idDisable'";
		                if(mysqli_query($conn, $disableQuery)){
							echo "<script>alert('The account " .$nameDesRes['UserName']. " has been deactivated!'); location.href = 'manage_users.php'; </script>";
		                }
        	    } else {
			            	echo "<script>alert('The account " .$nameDesRes['UserName']. " is already deactivated!');</script>";

        	    }
         	}
?>
                        </section>
        </section>
    </section>
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
<!-- AJAX UPDATE -->
<script>

  document.getElementById('usersnotif').onclick = function(){
if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
}else{// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    //do nothing
    }
  }
xmlhttp.open("GET","update_notifications.php",true);
xmlhttp.send();
}

</script>
</html>
