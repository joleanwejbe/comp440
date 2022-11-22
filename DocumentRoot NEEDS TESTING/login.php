<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
<?php 
    require('authenticate.php');
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='$password'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        $rows = mysqli_num_rows($result); ?>

<?php
        if ($rows == 1) {
		
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['username'] = $username;
		
		header('Location: home.php');
		
        } else {
		$_SESSION['message'] = 'Incorrect username/password';
	}
?>

<div class="login">
			<h1>Login</h1>
			<form action="login.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>

<?php
        if(isset($_SESSION['message']))
        {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
        }
    } 
?>


				<input type="submit" value="Login">                                                          
				
				<p class="link">Don't have an account? <a href="register.html">Register Now.</a></p>

			</form>			
		</div>
	</body>
</html>
