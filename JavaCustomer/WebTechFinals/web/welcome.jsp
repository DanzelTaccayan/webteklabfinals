

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ include file="WEB-INF/header.jsp"%>
<%@page session="true" %>
<%if(session.getAttribute("user") != null){%>
    <h1>Welcome to the page <%= session.getAttribute("user")%></h1>
<%}else{
    response.sendRedirect("index.jsp");
}
%>
<!--<h1>Welcome</h1>-->
<form action="LogoutServlet" method="GET">
    <input type="Submit" name="Logout">
</form>    
<%@ include file="WEB-INF/footer.jsp" %>
