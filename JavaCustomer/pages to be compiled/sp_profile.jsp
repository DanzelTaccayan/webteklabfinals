<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import = "java.sql.*"%>
<%@include file="WEB-INF/header.jsp"%>
<h1>Service Provider Profile</h1>
<%  
    try{
        String id = request.getParameter("serid");
        int serID = Integer.parseInt(id);
        Class.forName("com.mysql.cj.jdbc.Driver");
        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
        String sql = "SELECT services.sp_id, CONCAT(firstName, ' ', middleName, ' ', lastName) AS SP, address, email, contactNumber, company FROM user_details inner join services on services.sp_id = user_details.idUser inner join users on users.idUsers = services.sp_id WHERE services.service_id = ? AND user_details.usertype = 'SP'";
        PreparedStatement ps = con.prepareStatement(sql);
        ps.setInt(1, serID);
        ResultSet rs = ps.executeQuery();
        
        while(rs.next()){
%>          <pre>
            Name: <input type="text" value="<%= rs.getString("SP")%>" disabled>
            Company: <input type="text" value="<%= rs.getString("company")%>" disabled>
            Address: <input type="text" value="<%= rs.getString("address")%>" disabled>
            Email: <input type="text" value="<%= rs.getString("email")%>" disabled>
            Contact Number: <input type="text" value="<%= rs.getInt("contactNumber")%>" disabled>
            </pre>
            <h1>Services Offered</h1>
<%       
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
            String spid = (String) rs.getString("services.sp_id");
            int sppid = Integer.parseInt(spid);
            String sql2 = "SELECT service_name FROM services INNER JOIN user_details ON user_details.idUser = services.sp_id INNER JOIN users ON users.idUsers = user_details.idUser WHERE user_details.UserType = 'SP' and services.sp_id = "+sppid+"";
            PreparedStatement p = conn.prepareStatement(sql2);
            ResultSet r = p.executeQuery();
            while(r.next()){
%>
            <h1><%= r.getString("service_name")%></h1>
<%            
            }    
        }
    }catch(Exception e){
        
    }
%>
<%@include file="WEB-INF/footer.jsp" %>
