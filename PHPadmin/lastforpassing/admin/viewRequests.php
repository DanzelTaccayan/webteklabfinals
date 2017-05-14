<?php
include '../shared/connection.php';
include 'auth.php';
$checker = "SELECT * FROM request";
$checker_r=mysqli_query($conn, $checker);	

//notif number
$notif_num = "SELECT * from notifications where read_at is null";
$notif_num_result = mysqli_query($conn,$notif_num);

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
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
               <li> <button type="button" id='requestlist' class="btn btn-info" data-toggle="modal" data-target="#myModal" style='float:right;'><i class="fa fa-tasks"></i><span class="badge bg-theme">
                  <?php
                   $notifs = "SELECT * from notifications where notification_type='Admin' and read_at is null";
                   $notifs_result = mysqli_query($conn, $notifs);
                   echo mysqli_num_rows($notifs_result); 
                   ?>
               </span></button></li>
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
            
             <section id="main-content">
          <section class="wrapper site-min-height">
<h1> Requests </h1>
<form method="POST">
	<select id = 'request' name='requestSearch'>
		<option value = 'all'> All Requests </option>
		<option value = 'reject'> Rejected Requests </option>
		<option value = 'pending'> Pending Requests </option>
	</select>
	<input type="submit" name="requestSearchBtn" value="Search">
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
		$limit = 7;
		$current_page = 1;
		if (isset($_GET['page']) && $_GET['page'] > 0) 
		{
		    $current_page = $_GET['page'];
		}
		$offset = ($current_page * $limit) - $limit;

				$query = "CREATE OR REPLACE VIEW theService AS
    SELECT 
        service_id AS servID, service_name
    FROM
        request
            NATURAL JOIN
        services
    ORDER BY request_date";
$query2 = "CREATE OR REPLACE VIEW reqByNameAll AS
    SELECT 
    	r.idrequest,
        r.status,
        r.service_id,
        r.request_date,
        r.updated_at,
        CONCAT(lastName,
                ', ',
                firstName,
                ' ',
                middleName) AS reqBy
    FROM
        user_details
            JOIN
        request r
    WHERE
        idUser = requested_by
    ORDER BY request_date";
$query3 = "CREATE OR REPLACE VIEW reqToTable AS
    SELECT 
        CONCAT(lastName,
                ', ',
                firstName,
                ' ',
                middleName) AS reqTo
    FROM
        user_details
            JOIN
        request
    WHERE
        idUser = requested_to
    ORDER BY request_date";
    
    $query4 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";

				$resultQ = mysqli_query($conn, $query) or die(mysqli_error($conn));
				$resultQ1 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
				$resultQ2 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
				$resultQ2 = mysqli_query($conn, $query4) or die(mysqli_error($conn));

				$queryAll = "select * from theService natural join reqbynameall r natural join reqtotable group by idrequest";
						$theResult = mysqli_query($conn, $queryAll) or die(mysqli_error($conn));
						$totalrequest = mysqli_num_rows($theResult);

				$paginator = "select * from theService natural join reqbynameall r natural join reqtotable group by 3 LIMIT $offset, $limit";
						$paginatorQuery = mysqli_query($conn,$paginator) or die(mysqli_error($conn));
						$pages = ceil($totalrequest/$limit);
						


		if(isset($_POST['requestSearchBtn'])){
			if($_POST['requestSearch'] == 'all'){


				while($row = mysqli_fetch_array($paginatorQuery)){
					echo "<tr><td>" . $row['status'] . "</td>";
							echo "<td>" . $row['reqBy'] . "</td>";
							echo "<td>" . $row['reqTo'] . "</td>";
							echo "<td>" . $row['service_name'] . "</td>";
							echo "<td>" . $row['request_date'] . "</td>";
							echo "<td>" . $row['updated_at'] . "</td>";
				}
								echo "<a href = 'viewRequests.php'> See All </a>";

?> 


<?php
			}else if($_POST['requestSearch'] == 'reject'){

				$queryAll = "select * from theService natural join reqbynameall r natural join reqtotable where status = 'reject' group by idrequest";
						$theResult = mysqli_query($conn, $queryAll) or die(mysqli_error($conn));


				while($row = mysqli_fetch_array($theResult)){

					echo "<tr><td>" . $row['status'] . "</td>";
							echo "<td>" . $row['reqBy'] . "</td>";
							echo "<td>" . $row['reqTo'] . "</td>";
							echo "<td>" . $row['service_name'] . "</td>";
							echo "<td>" . $row['request_date'] . "</td>";
							echo "<td>" . $row['updated_at'] . "</td>";
				}
							echo "<a href = 'viewRequests.php'> See All </a>";

			}else if($_POST['requestSearch'] == 'pending'){
								$queryAll = "select * from theService natural join reqbynameall r natural join reqtotable where status = 'pending' group by idrequest";
						$theResult = mysqli_query($conn, $queryAll) or die(mysqli_error($conn));


				while($row = mysqli_fetch_array($theResult)){

					echo "<tr><td>" . $row['status'] . "</td>";
							echo "<td>" . $row['reqBy'] . "</td>";
							echo "<td>" . $row['reqTo'] . "</td>";
							echo "<td>" . $row['service_name'] . "</td>";
							echo "<td>" . $row['request_date'] . "</td>";
							echo "<td>" . $row['updated_at'] . "</td>";
				}
				echo "</tr>";
				echo "<a href = 'viewRequests.php'> See All </a>";
			}

		}else{



			while($row = mysqli_fetch_array($paginatorQuery)){
				echo "<tr><td>" . $row['status'] . "</td>";
						echo "<td>" . $row['reqBy'] . "</td>";
						echo "<td>" . $row['reqTo'] . "</td>";
						echo "<td>" . $row['service_name'] . "</td>";
						echo "<td>" . $row['request_date'] . "</td>";
						echo "<td>" . $row['updated_at'] . "</td>";
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
      <div class="page">
<ul class="pagination">
		  	<?php
				if($current_page == 1){
					echo "<li class='disabled'><a href='javascipt:void(0)'>&laquo;</a></li>";
				}else{
					echo "<li><a href='viewRequests.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
				}
				for($var = 1; $var <= $pages; $var++){
					echo "<li><a href='viewRequests.php?page=" .$var. "'>" .$var."</a></li>";
				}
				if($current_page == $pages){
					echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
				}else{
					$a = $current_page + 1;
					echo "<li><a href='viewRequests.php?page=" .$a. "'>&raquo;</a></li>";
				}
          if ($current_page > $pages) {
            echo "<script> alert('Invalid page!'); window.location='viewRequests.php'</script>";
          }

			?>
<?php
		}
		
		echo "</tr>";
	?>
        </ul>
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

  document.getElementById('requestlist').onclick = function (){
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