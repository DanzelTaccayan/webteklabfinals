<?php
include '../shared/connection.php';
include 'auth.php';
if (isset($_POST['searchUser'])) {
	$searchUser = $_POST['searchUser'];
}
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
          <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
               <li> <button type="button" id = 'feedbacknotif' class="btn btn-info" data-toggle="modal" data-target="#myModal" style='float:right;'><i class="fa fa-tasks"></i><span class="badge bg-theme">
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
                      <a class="active" href="feedback_log.php" >
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
<h1> Feedbacks </h1>
<table class="table table-hover">
<tr>
	<th> Sender </th>
	<th> Recipient </th>
	<th> Content </th>
</tr>
    
<?php

		$limit = 7;
		$current_page = 1;
		if (isset($_GET['page']) && $_GET['page'] > 0) 
		{
		    $current_page = $_GET['page'];
		}
		$offset = ($current_page * $limit) - $limit;

		//request_status
		$viewRes = "CREATE OR REPLACE VIEW theRes AS
            SELECT 
		idUser as a,
        content,
               CONCAT(lastName,
                ', ',
                firstName,
                ' ',
                middleName) AS resNames
    FROM
        feedback
            NATURAL JOIN
        user_details
    WHERE
        idUser = recepient";
        $viewSend = "CREATE OR REPLACE VIEW theSender AS
    SELECT 
		idUser as b,
        content,
        CONCAT(lastName,
                ', ',
                firstName,
                ' ',
                middleName) AS senderNames
    FROM
        feedback
            NATURAL JOIN
        user_details
    WHERE
        idUser = sender";

		$viewSendQ = mysqli_query($conn, $viewSend) or die(mysqli_error($conn));
		$viewResQ = mysqli_query($conn, $viewRes) or die(mysqli_error($conn));

        $feedBackTo = "select theRes.content, resNames, senderNames from theRes natural join theSender";
        $feedQuery = mysqli_query($conn, $feedBackTo) or die(mysqli_error($conn));
		$totalrequest = mysqli_num_rows($feedQuery);

        $paginator = "select theRes.content, resNames, senderNames from theRes natural join theSender LIMIT $offset, $limit";

		$paginatorQuery = mysqli_query($conn,$paginator) or die(mysqli_error($conn));
		$pages = ceil($totalrequest/$limit);

		while($row = mysqli_fetch_array($paginatorQuery)){
			echo "<tr><td>" . $row['senderNames'] . "</td>";
					echo "<td>" . $row['resNames'] . "</td>";
					echo "<td>" . $row['content'] . "</td>";

		}
		echo "</tr>";

	// }	

	?>
    
</table>
            <div class="page">
              <ul class="pagination">
			 <!--  <li><a href="#">1</a></li>
			  <li class="active"><a href="#">2</a></li>
			  <li><a href="#">3</a></li>
			  <li><a href="#">4</a></li>
			  <li><a href="#">5</a></li> -->
			  	<?php
					if($current_page == 1){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&laquo;</a></li>";
					}else{
						echo "<li><a href='feedback_log.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
					}
					for($var = 1; $var <= $pages; $var++){
						echo "<li><a href='feedback_log.php?page=" .$var. "'>" .$var."</a></li>";
					}
					if($current_page == $pages){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
					}else{
						$a = $current_page + 1;
						echo "<li><a href='feedback_log.php?page=" .$a. "'>&raquo;</a></li>";
					}
          if ($current_page > $pages) {
            echo "<script> alert('Invalid page!'); window.location = 'feedback_log.php';</script>";
          }

				?>
			</ul>
         </div>
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
            </section>
    </section>
    
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

 document.getElementById('feedbacknotif').onclick = function (){
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
