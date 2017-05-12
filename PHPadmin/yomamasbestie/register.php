<?php
	include '/shared/connection.php';
	if(isset($_POST['register'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user_type = $_POST['user_type'];
		$firstname = $_POST['firstname'];
		$middlename= $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$contact_no = $_POST['contact_no'];
		$company = $_POST['company'];

		$check_user = "SELECT * from users where username = '$username'";
		$check_user_qry = mysqli_query($conn, $check_user);
		if(mysqli_num_rows($check_user_qry) > 0){
			echo '<p>Username already exist<p>';
		}else{
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$register_user = "INSERT into users (UserName, Password, Status, UserType) VALUES ('$username', '$password_hash', 'pending', '$user_type')";
			$register_user_qry =mysqli_query($conn, $register_user);
			$id = mysqli_insert_id($conn);
			$register_details = "INSERT into user_details (idUser, firstName, middleName, lastName, address, email, contactNumber, company, created_at,updated_at) VALUES ('$id', '$firstname', '$middlename', '$lastname', '$address', '$email', '$contact_no', '$company', now(), now())";
			$register_details_qry = mysqli_query($conn, $register_details);
			//notification
			$admin_query = "SELECT UserType, idUser from user_details where UserType='admin'";
			$admin_query_result = mysqli_query($conn, $admin_query) or die(mysqli_error($conn));
			$admin_arr = mysqli_fetch_array($admin_query_result);
			$admin_id = $admin_arr['idUser'];
			

			$notif = "INSERT into notifications (receiver,data, created_at, updated_at) values ('$admin_id', 'Username " . "$username" . "  has registered a new account with a user type of  " . "$user_type', now(), now())";
			$notif_result = mysqli_query($conn,$notif) or die(mysqli_error($conn));

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Account</title>
</head>
<body>
<form action='register.php' method='POST'>
	Username: <input type='text' name='username' required><br>
	Password: <input type='password' name='password' required><br>
	User Type: <select name='user_type' required>
					<option value='SP'> Service Provider </option>
					<option value='customer'> Customer </option>
				</select> <br>
	First Name: <input type="text" name="firstname" required><br>
	Middle Name: <input type="text" name="middlename" required><br>
	Last Name: <input type="text" name="lastname" required><br>
	Email: <input type="email" name="email" required><br>
	Address: <input type="text" name="address"><br>
	Contact Number <input type="number" name="contact_no" required><br>
	Company: <input type="text" name='company'><br>
	<input type='submit' name='register' value='Create Account'>

</form>

</body>
</html>