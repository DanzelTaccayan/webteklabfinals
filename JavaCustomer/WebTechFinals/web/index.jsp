<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ include file="WEB-INF/header.jsp"%>
<%if(session.getAttribute("user") == null){%>
<h1>Welcome to the page</h1>
<form action="LoginServlet" method="POST">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <input type="submit" name="submit">
</form>
<%}else{
    response.sendRedirect("welcome.jsp");
}%>
<%@ include file="WEB-INF/footer.jsp"%>
