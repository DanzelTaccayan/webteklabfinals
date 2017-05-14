<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
         pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*" %>
<%@ page import="java.io.*" %>
<%@ page import="javax.servlet.http.*" %>

<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Login</title>
</head>
<body>
    <%

        response.setContentType("text/html;charset=UTF-8");
        String dbusername = (String) session.getAttribute("username");
        String dbusertype = (String) session.getAttribute("UserType");
        Connection conn = (Connection) getServletContext().getAttribute("conn");

        String sql = "SELECT * FROM users join user_details on (users.idUsers=user_details.idUser) WHERE users.UserName='"+dbusername+"' ";
       
        PreparedStatement ps = null;
        try {
            ps = (PreparedStatement) conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
       
            if(rs.next()) {
                if(rs.getString("users.status").toString().equals("Active")) {


                        session.setAttribute("name", dbusername);
                        session.setAttribute("user-id", rs.getString("user_details.idUser"));
                        session.setAttribute("usertype", rs.getString("user_details.UserType"));
                        session.setAttribute("userPasswd", rs.getString("users.Password"));


                        response.sendRedirect(response.encodeRedirectURL("http://localhost:8080/ClientModuleFinal/welcome.jsp"));

                } else {
                    session.invalidate();
                    response.sendRedirect(response.encodeRedirectURL("http://localhost/admin/index.php"));
                }
            } else {
                session.invalidate();
                response.sendRedirect(response.encodeRedirectURL("http://localhost/admin/index.php"));
            }
            rs.close();
            ps.close();
        } catch (Exception e) {
            PrintWriter cout = response.getWriter();
            out.println("Exception caught: " + e);
            e.printStackTrace();
        }
        %>
</body>
