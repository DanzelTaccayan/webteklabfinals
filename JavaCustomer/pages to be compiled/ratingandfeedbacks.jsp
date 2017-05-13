<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Ratings and Feedbacks</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

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
        <%
            Connection con = null;
            PreparedStatement ps = null;
            ResultSet rs = null;
            ResultSet rs2 = null;

            String driverName = "com.mysql.jdbc.Driver";
            Class.forName(driverName);
            String url = "jdbc:mysql://localhost:3306/webtekfinals";
            String user = "root";
            String password = "winter";
            con = DriverManager.getConnection(url, user, password);
            
            String uid = (String) session.getAttribute("user-id");
            int userid1 = Integer.parseInt(uid);
            String sql2 = "SELECT * FROM user_details where idUser="+userid1+" ";
            
            ps = con.prepareStatement(sql2);
            rs = ps.executeQuery();
        %>

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <%=session.getAttribute("name")%>
                </a>
                    <dd><%=session.getAttribute("usertype") %></dd>
            </div>

            <ul class="nav">
                <li class="">
                    <a href="welcome.jsp">
                        <i class="pe-7s-cart"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li>
                    <a href="profile.jsp">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="">
                    <a href="transactions.jsp">
                        <i class="pe-7s-display2"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="active">
                    <a href="ratingandfeedbacks.jsp">
                        <i class="pe-7s-like2"></i>
                        <p>Make a Feedback</p>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="pe-7s-plus"></i>
                        <p>Nav Bar</p>
                    </a>
                </li>

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Customer Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
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
                            <a href="logout.jsp">
                                Log out
                            </a>


                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Rate your Service Provider</h4>
                            </div>
                            
                            <%
                               String mysql = "select concat(user_details.firstName, ' ', user_details.lastName) as spname from user_details join services on(user_details.idUser=services.sp_id) where user_details.usertype='SP'";
                               
                               ps = con.prepareStatement(mysql);
                               rs2 = ps.executeQuery();
                               
                            %>
                                
                            <div class="content">
                                <form method="POST" action="update.jsp">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Provider</label>
                                                <select name="evaluatee" class="form-control" placeholder="Choose your Service Provider..." value="">
                                                    <option>Choose your Service Provider...</option>
                                                    <%
                                                       while(rs2.next()){
                                                            String spfname = rs2.getString("spname");
                                                    %>
                                                    <option name="evaluatee" value=<%=spfname%>><%=spfname%></option>
                                                    <%
                                                        }
                                                    %>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Feedback</label>
                                                <textarea name="user_feedback" rows="10" class="form-control" placeholder="Place your Feedback here..." value=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ratings</label>
                                                <input name="user_ratings" type="text" class="form-control" placeholder="Rate your Service Provider by 1-5" value="" >
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-left">Submit</button>
                                    
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Cancel</button>
                                    <div class="clearfix"></div>
                                </form>
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
                                    <img class="avatar border-gray" src="assets/img/faces/face-0.jpg" alt="..."/>
                                    
                                    <%
                                       while(rs.next()){
                                            String firstname = rs.getString("firstName");
                                            String lastname = rs.getString("lastName");
                                       %>
                                      <h4 class="title"><%=firstname%> <%=lastname%><br />
                                         <small><%=session.getAttribute("name")%></%></small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> Siyak ni Ethel Dawn Tufay Mejala! HAHAHA!
                                </p>
                                <% } %>
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


</html>
