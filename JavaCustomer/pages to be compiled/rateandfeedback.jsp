<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
         pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*" %> 
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Update Feedback</title>
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
            
            String spname = request.getParameter("evaluatee");

            String feedbck = request.getParameter("user-feedback");
            String user_rating = request.getParameter("user_ratings");
            int usr_rating = Integer.parseInt(user_rating);
           
            String uid = (String) session.getAttribute("user-id");
            int userid1 = Integer.parseInt(uid);
            
            String shit = "select idUser from user_details where firstName like '"+spname+"' ";
     
            try{
                ps = con.prepareStatement(shit);
                rs = ps.executeQuery();
                while(rs.next()){
                    String mysql = "insert into feedback(sender, recepient, content) values("+userid1+", '"+rs.getString("idUser")+"', "+feedbck+")";
                    try{
                        st = con.createStatement();
                        st.executeUpdate(mysql);
                        response.sendRedirect("ratingandfeedbacks.jsp");
                    } catch(SQLException e){
                        out.println(e);
                    }
                }
            }catch(SQLException g){
                
            }
           
            
            
            

//            response.sendRedirect("ratingandfeedbacks.jsp");
        %>
</body>
