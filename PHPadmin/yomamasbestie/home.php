<?php
include '/shared/connection.php';
include '/shared/auth.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<body>
<a href='logout.php' style = 'float: right;'> Logout </a>
<h1> Hello, Admin! </h1>
<nav>
  <a href="home.php">Home</a> |
  <a href="./admin/manage_users.php"> Manage Users </a> |
  <a href="#"> View feedbacks </a>
 
</nav>



</body>
</html>