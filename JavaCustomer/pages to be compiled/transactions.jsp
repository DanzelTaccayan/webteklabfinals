<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<%@page session="true"%>

<!doctype html>
<html lang="en">
<head>
    <!--meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"-->
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Welcome! <%=session.getAttribute("name")%></title>

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
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
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
                <li class="">
                    <a href="profile.jsp">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="active">
                    <a href="transactions.jsp">
                        <i class="pe-7s-display2"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="">
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
                    <%
                        Connection con = null;
                        PreparedStatement ps = null;
                        ResultSet rs = null;

                        String driverName = "com.mysql.jdbc.Driver";
                        Class.forName(driverName);
                        String url = "jdbc:mysql://localhost:3306/webtekfinals";
                        String user = "root";
                        String password = "winter";
                        con = DriverManager.getConnection(url, user, password);
                       
                        String uid = (String) session.getAttribute("user-id");
                        int userid1 = Integer.parseInt(uid);
                        
                        String sql = "select * from user_details join transaction on (user_details.idUser=transaction.sp_id) INNER JOIN services ON (transaction.service_id=services.service_id) inner JOIN request on (services.service_id=request.service_id) inner join feedback on (request.requested_to=feedback.recepient) where transaction.cust_id="+userid1+" and feedback.sender="+userid1+" order by transaction.created_at";
                       

                       
                        ps = con.prepareStatement(sql);

                        rs = ps.executeQuery();
                    %>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Transactions</h4>
                                <p class="category">Here are your previous and on-going Transactions you've been with these Service Providers.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Transaction ID</th>
                                        <th>Date Transacted</th>
                                        <th>Service Provider</th>
                                        <th>Service</th>
                                    	<th>Service Description</th>
                                        <th>Transaction Status</th>
                                        <th>Feedback</th>
                                    </thead>
                                    <tbody>
                                    <%
                                        while(rs.next()){
                                            String transaction_id = rs.getString("transaction.transaction_id");
                                            String transaction_date = rs.getString("transaction.created_at");
                                            int sp_id1 = rs.getInt("transaction.sp_id");
                                            String sp_fn = rs.getString("user_details.firstName");
                                            String sp_ln = rs.getString("user_details.lastName");
                                            String service_nm = rs.getString("services.service_name");
                                            String service_desc = "asdasds";
                                            String transaction_status = rs.getString("transaction.transaction_status");
                                            String feedback = rs.getString("feedback.content");
                                            
                                    %>
                                        <tr><form method='POST' action='UpdateFeedback'>
                                            <td><%=transaction_id%></td>        <!-- di ko alam kung anong specifi na service na nagfeedback si customer -->
                                            <td><%=transaction_date%></td>
                                            <td><%=sp_fn%> <%=sp_ln%></td>
                                            <td><%=service_nm%></td>
                                            <td><%=service_desc%></td>
                                            <td><%=transaction_status%></td>
                                            <td><input type="hidden" name="specific_spid" value="<%=sp_id1%>"/>
                                                <%
                                                   if(transaction_status.equals("ongoing")){
                                                        out.print("<textarea rows='5' class='form-control' disabled placeholder='Feedback' value='Place your feedback here.'>" +feedback+ "</textarea>");
                                                   } else{
                                                        out.print("<textarea rows='5' name='custfeedback' class='form-control' placeholder='Feedback' value='Place your feedback here.'>" +feedback+ "</textarea><button type='submit' class='btn btn-info btn-fill pull-right'>Update</button>");
                                                    }
                                                %>
                                            </td>
                                            </form>
                                        </tr>
                                    <%   } 
                                    %> 
                                    </tbody>
                                </table>

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
<script>
    window.onload = function () {
        if (! localStorage.justOnce) {
            localStorage.setItem("justOnce", "true");
            window.location.reload();
        }
    }
</script>
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
