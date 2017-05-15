<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import = "java.sql.*"%>
<%@include file="WEB-INF/header.jsp"%>
<form name="ser" method="POST">
    Search: <input type="text" name="searchInpt" id="searchbar">
    <input type="submit" id="" name="submit" value="Search Service">
</form>

    <%String subBtn = request.getParameter("submit");%>
    <h1><%=subBtn%></h1>
<ul>    
<%    
    if(subBtn != null && subBtn.equals("Search Service")){
        try{
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
//            String sql = "SELECT services.service_id as SERID, CONCAT(firstname, ' ', middleName, ' ', lastName) as SP, user_details.idUser as SPID, company, services.service_name as SERNAME from user_details inner join services on user_details.idUser = services.sp_id inner join users on user_details.idUser = users.idUsers WHERE (services.service_name LIKE ?) AND user_details.usertype = 'SP'";
            String sql2 = "SELECT services.service_id as SERID, CONCAT(firstName, middleName, lastName) AS SP, user_details.idUser as SPID, service_name AS service FROM services LEFT JOIN user_details ON sp_id = idUser WHERE (CONCAT(firstName, middleName, lastName) LIKE ? or service_name LIKE ?)";
            PreparedStatement ps = con.prepareStatement(sql2);
            ps.setString(1, '%'+request.getParameter("searchInpt")+'%');
            ps.setString(2, '%'+request.getParameter("searchInpt")+'%');
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                String sp = rs.getString("SP");
    %>  
        <li><a href="sp_profile.jsp?serid=<%=rs.getInt("SERID")%>"><%= sp%></a></li>  
    <%
            }    
        }catch(Exception e){
            e.printStackTrace();
        }
    }
    %>
    </ul>
<%@ include file="WEB-INF/footer.jsp"%>
