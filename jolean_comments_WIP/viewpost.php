<!DOCTYPE html>
<html>
	<head>
		<mset="utf-8">
		<title>View Post</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>COMP 440 Database Design Fall 2022</h1>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="blog.php"><i class='fas fa-book'></i>Blog</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Blog Post</h2>
</html>

<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}



require('authenticate.php');

	$id=$_GET['id'];        // Collect data from query string

	// display the blog
	$sql = "SELECT * FROM blogs WHERE blogid=$id";
	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		echo'<div>';
                	echo '<h1>'.$row['subject'].'</a></h1>';
			echo '<p>Blog id: '.$row['blogid'].'</p>';
			echo '<p>Author: '.$row['created_by'].'</p>';
			echo '<p>Date: '.$row['pdate'].'</p>';
                	echo '<p>'.$row['description'].'</p>';
            	echo '</div>';
		}
	} 
	else
	{
		echo "No blog posts";
	}


	// display existing comments
	$sql = "SELECT * FROM comments WHERE blogid=$id";
	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		echo'<div>';
                	echo '<h1>'.$row['sentiment'].'</a></h1>';
			echo '<p>Comment id: '.$row['commentid'].'</p>';
			echo '<p>Author: '.$row['posted_by'].'</p>';
			echo '<p>Date: '.$row['cdate'].'</p>';
                	echo '<p>'.$row['description'].'</p>';
            	echo '</div>';
		}
	} 
	else
	{
		echo "No comments";
	}






	$con->close();
?>
