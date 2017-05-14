<?php
include 'login.php';


if(isset($_SESSION['username']) && $_SESSION['UserType'] =='admin') {
	header("Location: dashboard.php");
}else if(isset($_SESSION['username']) && $_SESSION['UserType'] =='SP') {
	//header redd
}else if(isset($_SESSION['username']) && $_SESSION['UserType'] =='customer') {
	//header gelo
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
    <!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
    <!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
    <!--[if IE 9]> <html class="no-js ie9 oldie" lang="en"> <![endif]-->
    <meta charset="utf-8">
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Coming soon, Bootstrap, Bootstrap 3.0, Free Coming Soon, free coming soon, free template, coming soon template, Html template, html template, html5, Code lab, codelab, codelab coming soon template, bootstrap coming soon template">
    <title>Welcome to Login</title>
  
    
    <!-- ============ Add custom CSS here ============ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     
   
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="css/style.css" rel="stylesheet" type="text/css" /> 
       <link href="css/placing.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand" href="#">YoMAMASBESTIE</a>
          
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./register.php">Register</a>
                </li>     
            </ul>
        </div>
    </div>
</div>

        <div class="container">
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
           <div id="banner">
             <h1><strong> </strong> </h1>

            <h5><strong></strong></h5>
           
           </div>
          
              
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="registrationform">
            <form form method='POST' action='index.php' role='login' class="form-horizontal">
                <fieldset>
                    <legend>Login <i class="fa fa-pencil pull-right"></i></legend>
                    <div class="form-group">
                       
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control"  placeholder="Username" required/>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" placeholder="Password" required/>
                        </div>
                        </div>
                    
                        <div class="button-vertical">
                    <div class="form-group">
                            <div class="submitbtn">
                            <button type="submit" name="submit" class="btn btn-primary">
                                Log-in</button>
                                
                            </div>
                             <a href="register.php"><p class="createAcc">Create an account</p></a> 
                        </div>
                    </div>
            </fieldset>        

            </form>
                <p class="createAcc formsa"> note: registration of accounts will be approved by admin </p>
         </div>

         </div>
        </div>
    
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery.backstretch.js" type="text/javascript"></script>
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
<!--
    <form method='POST' action='index.php' role='login'>
	Username: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
	<input type='submit' name='submit'>
</form>
<a href='register.php'> Register </a>
<p> note: registration of accounts will be approved by admin </p>
-->

</body>
</html>
