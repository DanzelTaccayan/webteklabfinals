<%-- 
    Document   : request
    Created on : 05 13, 17, 8:38:28 PM
    Author     : 21518
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <form action="RequestServlet" method="POST">
            <input type="hidden" name="sid" value="<%=request.getParameter("serviceid")%>">
            <input type="hidden" name="spid" value="<%=request.getParameter("sproviderid")%>">
            Date: <input type="date" id="date" name="reqdate">
            Time: <input type="time" id="time" name="reqtime">
            Description: <textarea name="desc"></textarea>
            <input type="submit" name="request">
        </form>
    </body>
</html>
