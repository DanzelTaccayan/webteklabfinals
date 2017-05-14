<%-- 
    Document   : sample
    Created on : Apr 27, 2017, 11:27:49 AM
    Author     : Lydwald
--%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
         pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Hello World!</h1>
        <%
            Connection con = null;
            PreparedStatement ps = null;
            ResultSet rs = null;

            String driverName = "com.mysql.jdbc.Driver";
            Class.forName(driverName);
            String url = "jdbc:mysql://localhost:3306/test";
            String user = "root";
            String password = "winter";
            con = DriverManager.getConnection(url, user, password);

            String sql = "select name from userdetail";
            ps = con.prepareStatement(sql);
            rs = ps.executeQuery();
        %>
        
        <%
            while(rs.next()){
                String namae = rs.getString("name");
        %>
        <p>Your name is <%=namae%></p>
        <%   } 
        %>
            
    </body>
</html>
