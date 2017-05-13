<?php
include '/shared/connection.php';
include '/shared/auth.php';
$transactions = "SELECT * from transaction order by transaction_id desc;";
$transactions_result = mysqli_query($conn, $transactions) or die(mysqli_error($conn));

//notif number
$notif_num = "SELECT * from notifications where read_at is null";
$notif_num_result = mysqli_query($conn,$notif_num);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Services</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">   
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
 
    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="./css/placing.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <a href="dashboard.php" class="logo"><b>BESTIE SALON</b></a>
            <!--logo end-->
            
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
         
<div class="nav notify-row" id="top_menu">
    
       <li> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style='float:right;'><i class="fa fa-tasks"></i><span class="badge bg-theme"><?php echo mysqli_num_rows($notif_num_result);?></span></button></li>

          </div>       <!-- settings end -->
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
              
              	  <p class="centered"><a href="profile.php"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">BESTIE</h5>
              	  	
                  <li class="mt">
                      <a class="active" href="dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="./admin/manage_users.php" >
                          <i class="fa fa-desktop"></i>
                          <span>Manage Users</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="./admin/users.php" >
                          <i class="fa fa-book"></i>
                          <span>Users</span>
                      </a>
                   <li class="sub-menu">
                      <a href="./admin/viewRequests.php" >
                          <i class="fa fa-tasks"></i>
                          <span>View Requests</span>
                      </a>
                    <li class="sub-menu">
                        <a href="./admin/transactions.php">
                            <i class="fa fa-tasks"></i>
                            <span>View Transactions</span>
                        </a>
                  <li class="sub-menu">
                      <a href="./admin/feedback_log.php" >
                          <i class="fa fa-book"></i>
                          <span>Feedbacks</span>
                      </a>
                
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li_star"></span>
					  			<h3>
                                
                                <?php 
                                    $totalUser = "SELECT count(idUser) as TotalUsers from user_details;";
                                    $totalUserQ = mysqli_query($conn, $totalUser);
	                               $totalUserResult = mysqli_fetch_array($totalUserQ);
                                   echo "<div>" . $totalUserResult['TotalUsers'] . "</div>";

                                ?>    
                                    
                                </h3>
                  			</div>
                            <?php echo "<p> Wow! Great we have " . $totalUserResult['TotalUsers'] . " Users! Whoohoo!</p>"; ?>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_user"></span>
					  			<h3>
                                
                                <?php
                                  $totalCust = "SELECT count(idUser) as totalCust from user_details where UserType='customer';";
	                               $totalCustQ = mysqli_query($conn, $totalCust);  
                                    $totalCustResult = mysqli_fetch_array($totalCustQ);
	
                                    echo "<div>" . $totalCustResult['totalCust'] . "</div?>";
                                ?>
                                
                                </h3>
                  			</div>
                            <?php
					  			echo "<p> Cool we have  " . $totalCustResult['totalCust'] . " Customers</p>";
                            ?>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_tag"></span>
					  			<h3>
                            <?php    
                            $totalSp = "SELECT count(idUser) as TotalSp from user_details where UserType='SP';";
                            $totalSpQ = mysqli_query($conn, $totalSp);
                            $totalSpResult = mysqli_fetch_array($totalSpQ);
	                        echo "<div>" . $totalSpResult['TotalSp'] . "</div>";
                            ?>        
                                
                                </h3>
                  			</div>
                            <?php
					  			echo "<p>Awsome! " . $totalSpResult['TotalSp'] . " Service Providers </p>"
                            ?>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_fire"></span>
					  			<h3>
                                
                                <?php
                                  $totalOngoing = "SELECT count(transaction_id) as totalOngo from transaction where transaction_status='ongoing';";
	                               $totalOngoingQ = mysqli_query($conn, $totalOngoing);  
                                    $totalOngoingResult = mysqli_fetch_array($totalOngoingQ);
	                               echo "<div>" . $totalOngoingResult['totalOngo'] . "</div>";
                                ?>
                                
                                </h3>
                  			</div>
                            <?php
					  			echo "<p> There are " . $totalOngoingResult['totalOngo'] . " Transaction </p>";
                            ?>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>Hey!</h3>
                  			</div>
					  			<p>Your server is working perfectly. Relax & enjoy.</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
            
                  
                      
                      <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn donut-chart">
                      			<div class="white-header">
						  			<h5>SERVER LOAD</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-database"></i> 70%</p>
									</div>
	                      		</div>
								<canvas id="serverstatus01" height="120" width="120"></canvas>
								<script>
									var doughnutData = [
											{
												value: 70,
												color:"#68dff0"
											},
											{
												value : 30,
												color : "#fdfdfd"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
								</script>
	                      	</div><! --/grey-panel -->
                      	</div><!-- /col-md-4-->
                      	

                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5><a href="#">Facebook Page</a></h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-heart"></i> 122</p>
									</div>
									<div class="col-sm-6 col-xs-6"></div>
	                      		</div>
	                      		<div class="centered">
										<img src="assets/img/fb.png" width="120">
	                      		</div>
                      		</div>
                      	</div><!-- /col-md-4 -->
                      	
						<div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>TOP USER</h5>
								</div>
								<p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
								<p><b>Zac Snider</b></p>
								<div class="row">
									<div class="col-md-6">
										<p class="small mt">MEMBER SINCE</p>
										<p>2012</p>
									</div>
									<div class="col-md-6">
										<p class="small mt">TOTAL SPEND</p>
										<p>$ 47,60</p>
									</div>
								</div>
							</div>
						</div><!-- /col-md-4 -->
                      	

                    </div><!-- /row -->
                    
                    				
					<div class="row">
						<!-- TWITTER PANEL -->
						<div class="col-md-4 mb">
                      		<div class="darkblue-panel pn">
                      			<div class="darkblue-header">
						  			<h5>DROPBOX STATICS</h5>
                      			</div>
								<canvas id="serverstatus02" height="120" width="120"></canvas>
								<script>
									var doughnutData = [
											{
												value: 60,
												color:"#68dff0"
											},
											{
												value : 40,
												color : "#444c57"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
								</script>
								<p>April 17, 2014</p>
								<footer>
									<div class="pull-left">
										<h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
									</div>
									<div class="pull-right">
										<h5>60% Used</h5>
									</div>
								</footer>
                      		</div><! -- /darkblue panel -->
						</div><!-- /col-md-4 -->
						
						
						<div class="col-md-4 mb">
							<!-- INSTAGRAM PANEL -->
							<div class="instagram-panel pn">
								<i class="fa fa-instagram fa-4x"></i>
								<p>@THISISYOU<br/>
									5 min. ago
								</p>
								<p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
							</div>
						</div><!-- /col-md-4 -->
						
						<div class="col-md-4 col-sm-4 mb">
							<!-- REVENUE PANEL -->
							<div class="darkblue-panel pn">
								<div class="darkblue-header">
									<h5>REVENUE</h5>
								</div>
								<div class="chart mt">
									<div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
								</div>
								<p class="mt"><b>$ 17,980</b><br/>Month Income</p>
							</div>
						</div><!-- /col-md-4 -->
						
					</div><!-- /row -->
			
             
                  </div>  <!-- col-lg-9 END SECTION MIDDLE -->
    
                
                 <!-- START of RIGHT SIDE PANEL -->
                <div class="col-lg-3 ds">    
                    <h3>Top Service Providers</h3>
                    <?php 
                        $spRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) AS evaluatee, AVG(rating) as rating FROM webtekfinals.user_details ud JOIN rating r ON ud.idUser = r.evaluatee WHERE UserType = 'SP' GROUP BY idUser ORDER BY 2 desc limit 10";
                        $result = mysqli_query($conn, $spRating);
                    ?>
                   
                    <table class="table table-hover">
                        <tr>
                            <th>Service Provider</th>
                            <th>Rating</th>
                        </tr>
                        
                    <?php

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr><td>" . $row['evaluatee'] . "</td>";
                            echo "<td>" . $row['rating'] . "</td></tr>";
                        }

                    echo "</table>";
                                
                    $custRating = "SELECT CONCAT(lastName,', ',firstName,' ',middleName) AS evaluatee, AVG(rating) as rating FROM webtekfinals.user_details ud JOIN rating r ON ud.idUser = r.evaluatee WHERE UserType = 'customer' GROUP BY idUser ORDER BY 2 desc limit 10";
                    $result = mysqli_query($conn, $custRating);
                    ?>
                  
                        <!-- Top Customers -->
                        <h3>Top Customers</h3>
                            <table class="table table-hover">
                                <tr>
                                    <th>Customers</th>
                                    <th>Rating</th>
                                </tr>
                            <?php

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr><td>" . $row['evaluatee'] . "</td>";
                                    echo "<td>" . $row['rating'] . "</td></tr>";
                                }

                                echo "</table>";
   
                            ?>
                          

                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      </div>    
              </div><!--/row -->
       
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
          	echo "<div><a href='./admin/manage_users.php'> ".$arr['data']."</a></div><hr>"; 
          }
            echo "<a href='./admin/view_notif.php'>See more</a>";


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
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2017 - YO MOMMA's BESTIE
              <a href="dashboard.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
      

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <!--script for this page-->
    <script src="assets/js/zabuto_calendar.js"></script>	
    <!-- FOR CALLENDAR -->
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                }
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>  
	
  

  </body>
</html>
