<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
require('authenticate.php');
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$username = $_SESSION['username'];
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$query = "SELECT password,email FROM `users` WHERE username='$username'";

$stmt = $con->prepare($query);
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['username']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Profile</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="blog.php"><i class="fas fa-user-circle"></i>Blog</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
