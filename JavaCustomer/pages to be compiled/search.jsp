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
            String sql = "SELECT services.service_id as SERID, CONCAT(firstname, ' ', middleName, ' ', lastName) as SP, user_details.idUser as SPID, company, services.service_name as SERNAME from user_details inner join services on user_details.idUser = services.sp_id inner join users on user_details.idUser = users.idUsers WHERE (services.service_name LIKE ?) AND user_details.usertype = 'SP'";
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, request.getParameter("searchInpt"));
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                String sp = rs.getString("sp");
    %>  
        <li><a href="profile.jsp?serid=<%=rs.getInt("SERID")%>"><%= sp%></a></li>  
    <%
            }    
        }catch(Exception e){
            e.printStackTrace();
        }
    }
    %>
    </ul>
<%@ include file="WEB-INF/footer.jsp"%>
