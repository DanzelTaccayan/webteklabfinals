<?php
include 'login.php';


if(isset($_SESSION['username']) && $_SESSION['UserType'] =='admin') {
	header("Location: home.php");
}else if(isset($_SESSION['username']) && $_SESSION['UserType'] =='SP') {
	//header redd
}else if(isset($_SESSION['username']) && $_SESSION['UserType'] =='customer') {
	//header gelo
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login to YoMamas</title>
</head>
<body>
<form method='POST' action='index.php' role='login'>
	Username: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
	<input type='submit' name='submit'>
</form>
<a href='register.php'> Register </a>
<p> note: registration of accounts will be approved by admin </p>
	


</body>
</html>