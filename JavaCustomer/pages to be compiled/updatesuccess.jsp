<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Success</title>
	</head>
	<body>
		<center><p style="color:red">Na-update en jy profile mo pards. Ag re-login ka tapnu goods.</p></center>
		<%
			getServletContext().getRequestDispatcher("/home.jsp").include(request, response);
		%>
	</body>
</html>