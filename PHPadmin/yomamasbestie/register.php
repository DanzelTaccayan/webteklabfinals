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
			

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Account</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>Register Account</title>
	 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="css/style.css" rel="stylesheet" type="text/css" />    
   
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
     <link href="css/placing.css" rel="stylesheet" type="text/css" />
 
</head>
<body>
<!-- <div class="form-group">
	 <div class="input-group">
<form action='register.php' method='POST'>
	 <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
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
	</div>
</div> -->
 <div class="placing">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="registrationform">
            <form method="POST" class="form-horizontal">
                <fieldset>
                    <legend>Registration Form <i class="fa fa-pencil pull-right"></i></legend>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Username</label>
                        <div class="col-lg-10">
                            <input type='text' class="form-control" name='username' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                        Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
				
                    User Type:
                     <select name='user_type' required>
					<option value='SP'> Service Provider </option>
					<option value='customer'> Customer </option>
					</select>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Firstname</label>
                        <div class="col-lg-10">
                            <input type="firstname" class="form-control" name="firstname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Middle Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="middlename" required>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Lastname</label>
                        <div class="col-lg-10">
                            <input type="lastname" class="form-control" name="lastname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Address</label>
                        <div class="col-lg-10">
                            <input type="address" class="form-control" name="address" required>
                        </div>
                     </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Contact Number</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" name="contact_no" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Company</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="company">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-warning">
                                Clear</button>
                            <button type='submit'  class="btn btn-warning" name='register' value='Create Account'>Register</button>
                                
                        </div>
                    </div>
                </fieldset>
            </form>
         </div>


            </div>
         </div>
       </body>
</html>