<%-- 
    Document   : dashboard
    Created on : 12-May-2017, 2:02:17 AM
    Author     : Eli
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/functions" prefix="fn"%>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Creative Tim
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.html">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.html">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="viewRequest.jsp">
                        <i class="pe-7s-note2"></i>
                        <p>REQUEST</p>
                    </a>
                </li>
                <li>
                    <a href="message.jsp">
                        <i class="pe-7s-news-paper"></i>
                        <p>Message</p>
                    </a>
                </li>
                <li>
                    <a href="icons.html">
                        <i class="pe-7s-science"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">
                        <i class="pe-7s-map-marker"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="upgrade.html">
                        <i class="pe-7s-rocket"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               Account
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dropdown
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Top Service Providers</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div>
                            <div class="content">
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>SERVICE PROVIDER</th>
                                            <th>RATING</th>
                                        </thead>
                                        <tbody>

                                            <%
                                                try {
                                                    String query = "SELECT user_details.company, AVG(rating) AS rate FROM rating JOIN user_details ON(rating.evaluatee = user_details.idUser) WHERE user_details.UserType = 'SP' GROUP BY user_details.idUser ORDER BY rate DESC LIMIT 5";
                                                    Class.forName("com.mysql.jdbc.Driver").newInstance();
                                                    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
                                                    Statement st = con.createStatement();
                                                    ResultSet rs = st.executeQuery(query);

                                                    while (rs.next()) {
                                                        %>

                                            <tr>
                                                <td><%=rs.getString("user_details.company")%></td>
                                                <td><%=rs.getString("rate")%></td>
                                            </tr>            
                                                        <%
                                                    }
                                                } catch(Exception e) {

                                                }

                                            %>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Bounce
                                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                            
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Request</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div>
                            <div class="content">
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>REQUEST ID</th>
                                            <th>SERVICE</th>
                                        </thead>
                                        <tbody>

                                            <%
                                                try {
                                                    boolean q1 = true;
                                                    boolean q2 = true;
                                                    boolean q3 = true;
                                                    boolean q4 = true;
                                                    
                                                    String query1 = "SELECT COUNT(request.idrequest) AS trequest FROM users JOIN user_details ON(users.idUsers = user_details.idUser) INNER JOIN request ON (user_details.idUser = request.requested_to) INNER JOIN services ON (request.service_id = services.service_id)";
                                                    String query2 = "SELECT COUNT(request.idrequest) AS arequest FROM users JOIN user_details ON(users.idUsers = user_details.idUser) INNER JOIN request ON (user_details.idUser = request.requested_to) INNER JOIN services ON (request.service_id = services.service_id) WHERE request.status = 'pending'";
                                                    String query3 = "SELECT COUNT(request.idrequest) AS rrequest FROM users JOIN user_details ON(users.idUsers = user_details.idUser) INNER JOIN request ON (user_details.idUser = request.requested_to) INNER JOIN services ON (request.service_id = services.service_id) WHERE request.status = 'reject'";
                                                    Class.forName("com.mysql.jdbc.Driver").newInstance();
                                                    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
                                                    Statement st = con.createStatement();
                                                    ResultSet rs;

                                                    
                                                        %>
                                                    
                                                    <%
                                                    
                                                        
                                                        if (q1) {
                                                            
                                                            rs = st.executeQuery(query1);
                                                            while(rs.next()) {
                                                                    %>
                                                                    <tr>
                                                                        <td>Total # of Request</td>
                                                                        <td><%=rs.getString("trequest")%></td>
                                                                    </tr>
                                                                    <%
                                                            }    
                                                        }
                                                        if (q2) {
                                                            
                                                            rs = st.executeQuery(query2);
                                                            while(rs.next()) {
                                                                    %>
                                                                    <tr>
                                                                        <td>Accepted Request</td>
                                                                        <td><%=rs.getString("arequest")%></td>
                                                                    </tr>
                                                                    <%
                                                            }    
                                                        }
                                                        if (q3) {
                                                            
                                                            rs = st.executeQuery(query3);
                                                            while(rs.next()) {
                                                                    %>
                                                                    <tr>
                                                                        <td>Rejected Request</td>
                                                                        <td><%=rs.getString("rrequest")%></td>
                                                                    </tr>
                                                                    <%
                                                            }    
                                                        }
                                                    
                                                        
                                                            
                                                            
                                            
                                                    %>
                                                    
                                                    
                                            
                                            
                                            
                                                        <%
                                                    
                                                } catch(Exception e) {
                                                    e.printStackTrace();
                                                }
                                            
                                            %>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Bounce
                                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                        
                                            
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/face-3.jpg" alt="..."/>

                                      <h4 class="title">Mike Andrew<br />
                                         <small>michael24</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "Lamborghini Mercy <br>
                                                    Your chick she so thirsty <br>
                                                    I'm in that two seat Lambo"
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>                            
                <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Requests</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody style="height:250px; overflow-y:scroll; display:block;">
                                            <%
                                                    try {
                                                        String query = "SELECT * FROM users JOIN user_details ON(users.idUsers = user_details.idUser) INNER JOIN request ON (user_details.idUser = request.requested_to) INNER JOIN services ON (request.service_id = services.service_id) ORDER BY idrequest DESC";
                                                        Class.forName("com.mysql.jdbc.Driver").newInstance();
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
                                                        Statement st = con.createStatement();
                                                        ResultSet rs = st.executeQuery(query);

                                                        while (rs.next()) {
                                                    %>
                                            <tr>
                                                <c:set var = "rdate" value = '<%=rs.getString("request.request_date")%>' />
                                                <c:set var = "sdate" property="date" value = "${fn:substring(rdate, 0, 10)}" />
                                                <td>${sdate}</td>
                                               
                                                <td><%=rs.getString("services.service_name")%></td>

                                                <td class="td-actions text-right">
                                                    <a href="requestDetails.jsp">View Details</a>
                                                </td>
                                            </tr>
                                            <%
                                                        }
                                                   } catch(Exception e) {

                                                   }
                                            %>
                                            
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="" data-toggle="checkbox">
                                                    </label>
                                                </td>
                                                <td>Unfollow 5 enemies from twitter </td>
                                                <td class="td-actions text-right">
                                                    <a href="requestDetails.jsp">View Details</a>
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>  
                                            
                <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Transactions</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody style="height:250px; overflow-y:scroll; display:block;">
                                            <%
                                                    try {
                                                        String query = "SELECT * FROM user_details JOIN transaction ON (user_details.idUser = transaction.cust_id) INNER JOIN services ON (transaction.service_id = services.service_id) ORDER BY transaction_id";
                                                        Class.forName("com.mysql.jdbc.Driver").newInstance();
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
                                                        Statement st = con.createStatement();
                                                        ResultSet rs = st.executeQuery(query);

                                                        while (rs.next()) {
                                                    %>
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="" data-toggle="checkbox">
                                                    </label>
                                                </td>
                                                
                                                <td><%=rs.getString("services.service_name")%></td>
                                                

                                                <td class="td-actions text-right">
                                                    <a href="transactionDetails.jsp">View Details</a>
                                                </td>
                                            </tr>
                                            <%
                                                        }
                                                   } catch(Exception e) {

                                                   }
                                            %>
                                            
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="" data-toggle="checkbox">
                                                    </label>
                                                </td>
                                                <td>Unfollow 5 enemies from twitter</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2016 <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>

