<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
         pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*" %> 
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Update Profile</title>
</head>
<body>
        <%
            Connection con = null;
            PreparedStatement ps = null;
            ResultSet rs = null;
            Statement st = null;

            String driverName = "com.mysql.jdbc.Driver";
            Class.forName(driverName);
            String url = "jdbc:mysql://localhost:3306/webtekfinals";
            String user = "root";
            String password = "winter";
            con = DriverManager.getConnection(url, user, password);
            
            String uname = request.getParameter("usrname");
            String contact = request.getParameter("contactuser");
            String firstnme = request.getParameter("fname");
            String lastnme = request.getParameter("lname");
            String addr = request.getParameter("useraddress");
           String userpasswd = request.getParameter("userpasswd");
           String useremail = request.getParameter("useremail");
           

           
            String uid = (String) session.getAttribute("user-id");
            int userid1 = Integer.parseInt(uid);
            String updatesql = "update user_details set firstName='"+firstnme+"', lastName='"+lastnme+"', address='"+addr+"', email='"+useremail+"', contactNumber='"+contact+"' where idUser="+userid1+"";
            String updatesql2 = "update users set UserName='"+uname+"', Password='"+userpasswd+"' where idUsers="+userid1+"";
           
            try{
                st = con.createStatement();
                st.executeUpdate(updatesql);
                st.executeUpdate(updatesql2);
            } catch(SQLException e){
                out.println(e);
            }
            response.sendRedirect("profile.jsp");
        %>
</body>
