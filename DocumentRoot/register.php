<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8">
                <title>Register</title>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
                <link href="style.css" rel="stylesheet" type="text/css">
        </head>
        <body>
		<div class="register">
		<h1> Registration </h1>
		<form class="form" method="post" name="registration">

<?php
    require('authenticate.php');

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $firstname = stripslashes($_REQUEST['firstname']);
        $firstname = mysqli_real_escape_string($con, $firstname);

        $lastname = stripslashes($_REQUEST['lastname']);
        $lastname = mysqli_real_escape_string($con, $lastname);

	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);

        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);


        $passwordConfirmation = stripslashes($_REQUEST['passwordConfirmation']);
        $passwordConfirmation = mysqli_real_escape_string($con, $passwordConfirmation);

	if($_REQUEST["password"] != $_REQUEST["passwordConfirmation"]){

	 echo "
              <h3>Passwords do not match.</h3> </br>
              <p class='link'>Click here to <a href='register.html'>register</a> again </p>
              ";		
	exit();
	}

	$queryCheck = "SELECT * FROM `user` WHERE username = '$username' OR email = '$email'";
	$resultDupes = mysqli_query($con, $queryCheck);
	
	if(mysqli_num_rows($resultDupes)){
            echo "
                  <h3>Invalid input.</h3>
                  <p class='link'>Click here to <a href='register.html'>register</a> again </p>
                  ";

	}
	else{

        $query    = "INSERT into `user` (firstname, lastname, username, password, email )
                     VALUES ('$firstname','$lastname','$username', '$password', '$email')";
        $result   = mysqli_query($con, $query);
        
	if ($result) {

            echo "
                  <h3>You are registered successfully.</h3>
                  <p class='link'>Click here to <a href='index.html'>Login</a></p>
                  
		";
        } else {
            echo "
                  <h3>Invalid input.</h3>
                  <p class='link'>Click here to <a href='register.html'>registration</a> again.</p>
                  ";
        }
}
   
 }

 
?>



<br>
			</form>
		</div>
        </body>
</html>

