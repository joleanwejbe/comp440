<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>COMP 440 Database Design Fall 2022</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href= "comments.php"><i class ="fas fa-book"></i>Blogs</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		
			<form action="initialtable.php">
                	<input type="submit" value="Initialize database">
            		</form>
			<form action="RegisterBlog.php">
                	<input type="submit" value="Register blog">
            </form>
		</div>
	</body>
</html>