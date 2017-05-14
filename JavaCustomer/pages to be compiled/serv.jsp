<%-- 
    Document   : serv
    Created on : 05 13, 17, 1:50:02 PM
    Author     : 21518
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <ul>
    <%
        try{
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
            String sql = "SELECT services.service_name AS sn FROM services INNER JOIN user_details ON user_details.idUser = services.sp_id INNER JOIN users ON users.idUsers = user_details.idUser WHERE user_details.UserType = 'SP' GROUP BY 1";
            PreparedStatement ps = con.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                String servicename = rs.getString("sn");
    %>  
        <li><%= servicename%></li>
    <%
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
            String sql2 = "SELECT CONCAT(firstName, ' ', middleName, ' ', lastName) AS SP, company, service_name, services.service_id, user_details.idUser AS SPID FROM user_details INNER JOIN services ON services.sp_id = user_details.iduser INNER JOIN users ON users.idusers = user_details.iduser WHERE user_details.usertype='SP' and service_name = ?";
            PreparedStatement p = conn.prepareStatement(sql2);
            p.setString(1, servicename);
            ResultSet r = p.executeQuery();
            int cnt = 0;
    %>
            
            <%while(r.next()){%>
            <table>
                <tbody>
                    <tr>
                        <td><a href="profile.jsp?serid=<%=r.getInt("services.service_id")%>"> <%= r.getString("SP")%> </a></td>
                        <td><%=r.getString("company")%></td>
                        <td>
                            <a href="request.jsp?serviceid=<%=r.getInt("services.service_id")%>&sproviderid=<%=r.getInt("SPID")%>"> Request Service </a>
                        </td>
                    </tr>
                </tbody>
            </table>    
            <%
                cnt++ ;
                }
            %>
            
    <%
        }    
        }catch(Exception e){
            e.printStackTrace();
        }
    %>    
    </ul>
    <%
        session.setMaxInactiveInterval(2);
    %>
    <script type="text/javascript">
        var status = "<%=session.getAttribute("getAlert")%>";
        if(status != "null"){
            if(status == "Yes"){
                function alertInsert(){
                    alert("Insert Successful");
                }
            }else if (status == "No"){
                function alertInsertFail(){
                    alert("Insert Not Successful");
                }
            }
        }
    </script>
    <script type="text/javascript"> window.onload = alertInsert || alertInsertFail; </script>
    </body>
</html>
