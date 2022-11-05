<?php 
    session_start();
    require('authenticate.php');
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `user` WHERE username='$username'
                     AND password='$password'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
		//echo "weee";
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $username;
		header('Location: home.php');
		
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='index.html'>Login</a> again.</p>
                  </div>";
        }
    } 
?>
