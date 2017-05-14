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
			echo '<script> alert("Username already exist")</script>';
		}else{
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$register_user = "INSERT into users (UserName, Password, Status) VALUES ('$username', '$password_hash', 'pending')";
			$register_user_qry =mysqli_query($conn, $register_user);
			$id = mysqli_insert_id($conn);
			$register_details = "INSERT into user_details (idUser, firstName, middleName, lastName, address, email, contactNumber, company, created_at,updated_at, UserType) VALUES ('$id', '$firstname', '$middlename', '$lastname', '$address', '$email', '$contact_no', '$company', now(), now(),'$user_type')";
			$register_details_qry = mysqli_query($conn, $register_details) or die(mysqli_error($conn));
			// notification
			$admin_query = "SELECT UserType, idUser from user_details where UserType='admin'";
			$admin_query_result = mysqli_query($conn, $admin_query) or die(mysqli_error($conn));
			$admin_arr = mysqli_fetch_array($admin_query_result);
			$admin_id = $admin_arr['idUser'];
			

			$notif = "INSERT into notifications (receiver,data, created_at, updated_at) values ('$admin_id', 'Username " . "$username" . "  has registered a new account with a user type of  " . "$user_type', now(), now())";
			$notif_result = mysqli_query($conn,$notif) or die(mysqli_error($conn));
            
            echo '<script>location.href="index.php"</script>';

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
	 <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="./css/style.css" rel="stylesheet" type="text/css" />    
   
    <link href="./css/font-awesome.css" rel="stylesheet" type="text/css" />
     <link href="./css/placing.css" rel="stylesheet" type="text/css" />
  
 
</head>
<body>

 <div class="placing22">
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
				
                <div class="form-group">
                <label class="col-lg-2 control-label"> User Type:</label>
                <div class="col-lg-10">  
                     <select  class="form-control" name='user_type' required>
					<option value='SP'> Service Provider </option>
					<option value='customer'> Customer </option>
					</select>
                </div>
                    </div>

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
                            <button type='submit'  class="btn btn-warning" name='register' value='Create Account'>Register</button>                          
                    
                    </div>
                    </div>
                </fieldset>
            </form>
         </div>
                </div>

            </div>
        
           <script src="./js/jquery.js" type="text/javascript"></script>
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/jquery.backstretch.js" type="text/javascript"></script>
        <script type="text/javascript">
            'use strict';

            /* ========================== */
            /* ::::::: Backstrech ::::::: */
            /* ========================== */
            // You may also attach Backstretch to a block-level element
            $.backstretch(
        [
            "img/44.jpg",
            "img/colorful.jpg",
            "img/34.jpg",
            "img/images.jpg"
        ],

        {
            duration: 4500,
            fade: 1500
        }
    );
        </script>
       </body>
</html>