<?php
include '../shared/connection.php';
include '../shared/auth.php';
$transactions = "SELECT * from transaction order by transaction_id desc;";
$transactions_result = mysqli_query($conn, $transactions) or die(mysqli_error($conn));


?>

<!DOCTYPE html>
<html lang="en">
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
<!--
                      <ul class="sub">
                          <li><a  href="general.php">General</a></li>
                          <li><a  href="buttons.php">Buttons</a></li>
                          <li><a  href="panels.php">Panels</a></li>
                      </ul>
-->
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
        <!-- main content-->
        
        <section id="main-content">
          <section class="wrapper site-min-height">
                <h1> Transactions </h1>
                <a href='../dashboard.php'> Back to Home </a>
                <form id = 'searchTransaction' method='POST'>
                    <select name = 'statusTransac'>
                        <option value='all'> All Transactions </option>
                        <option value='on-going'> On Going </option>
                        <option value='done'> Done </option>
                    </select>
                    <input type='submit' name='searchTrans' value='Search'> 
                </form>

 
<?php
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
				while($transaction_arr = mysqli_fetch_array($transactions_result)){
				//sp
				$sp_num = $transaction_arr['sp_id'];
				$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
				$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
				$sp_arr = mysqli_fetch_array($nameSp_result);
				//customer
				$cust_num = $transaction_arr['cust_id'];
				$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
				$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
				$cust_arr = mysqli_fetch_array($nameCust_result);


				echo "<tr><td>" . $sp_arr['name'] . "</td>";
				echo "<td>" . $cust_arr['name'] . "</td>";
				echo "<td>" . $transaction_arr['transaction_status'] . "</td>";
				echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['transaction_id'] . "'>View Details </a></tr>";
				}
				}else{
					echo "<h1> No transactions </h1>";
				}
			}else if(
				$_POST['statusTransac'] == 'on-going'){
						
					
					$newtransac = "SELECT * from transaction where transaction_status = 'ongoing' order by transaction_id desc;";
					$newtransac_result = mysqli_query($conn, $newtransac);
					if(mysqli_num_rows($newtransac_result) != 0){
						echo "<table border='1'>";
						echo  "<tr>";
						echo  "<th> Service Provider </th>";
						echo  "<th> Customer </th>";
						echo  "<th> Status </th>";
						echo  "<th> Action </th>";
						echo  "</tr>";
					while($newtransac_array = mysqli_fetch_array($newtransac_result)){
						//sp
						$sp_num = $newtransac_array['sp_id'];
						$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
						$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
						$sp_arr = mysqli_fetch_array($nameSp_result);
						//customer
						$cust_num = $newtransac_array['cust_id'];
						$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
						$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
						$cust_arr = mysqli_fetch_array($nameCust_result);

						


						echo "<tr><td>" . $sp_arr['name'] . "</td>";
						echo "<td>" . $cust_arr['name'] . "</td>";
						echo "<td>" . $newtransac_array['transaction_status'] . "</td>";
						echo "<td><a href='view_transaction.php?transaction_id=". $newtransac_array['transaction_id'] . "'>View Details </a></tr>";
					}
				}else{
				echo "<h1> No on-going transactions </h1>";
				}
			}else if($_POST['statusTransac'] == 'done'){
				if(mysqli_num_rows($transactions_result) != 0){
						echo "<table border='1'>";
						echo  "<tr>";
						echo  "<th> Service Provider </th>";
						echo  "<th> Customer </th>";
						echo  "<th> Status </th>";
						echo  "<th> Action </th>";
						echo  "</tr>";
					$newtransac_done = "SELECT * from transaction where transaction_status = 'done' order by transaction_id desc;";
					$newtransac_done_result = mysqli_query($conn, $newtransac_done);
					while($new_transac_done_array = mysqli_fetch_array($newtransac_done_result)){
						//sp
						$sp_num = $new_transac_done_array['sp_id'];
						$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
						$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
						$sp_arr = mysqli_fetch_array($nameSp_result);
						//customer
						$cust_num = $new_transac_done_array['cust_id'];
						$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
						$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
						$cust_arr = mysqli_fetch_array($nameCust_result);

						

						echo "<tr><td>" . $sp_arr['name'] . "</td>";
						echo "<td>" . $cust_arr['name'] . "</td>";
						echo "<td>" . $new_transac_done_array['transaction_status'] . "</td>";
						echo "<td><a href='view_transaction.php?transaction_id=". $new_transac_done_array['transaction_id'] . "'>View Details </a></tr>";
					}
				}else{
				echo "<h1> No transactions completed </h1>";
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
				while($transaction_arr = mysqli_fetch_array($transactions_result)){
				//sp
					$sp_num = $transaction_arr['sp_id'];
					$nameSp = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$sp_num'";
					$nameSp_result = mysqli_query($conn, $nameSp) or die(mysqli_error($conn));
					$sp_arr = mysqli_fetch_array($nameSp_result);
					//customer
					$cust_num = $transaction_arr['cust_id'];
					$nameCust = "SELECT concat(firstName, ' ', middleName, ' ', lastName) as name from user_details where idUser = '$cust_num'";
					$nameCust_result = mysqli_query($conn, $nameCust) or die(mysqli_error($conn));
					$cust_arr = mysqli_fetch_array($nameCust_result);

					


					echo "<tr><td>" . $sp_arr['name'] . "</td>";
					echo "<td>" . $cust_arr['name'] . "</td>";
					echo "<td>" . $transaction_arr['transaction_status'] . "</td>";
					echo "<td><a href='view_transaction.php?transaction_id=". $transaction_arr['transaction_id'] . "'>View Details </a></tr>";

			}

			}else{
				echo "<h1> No transactions </h1>";
			}
			
		}


		
	?>
              </table>
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