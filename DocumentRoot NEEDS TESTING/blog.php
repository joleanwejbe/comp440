<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<mset="utf-8">
		<title>Blogs Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<a href="home.php"><h1> COMP 440 Database Design Fall 2022</h1></a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="blog.php"><i class="fas fa-newspaper"></i>Blog</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

			</div>
		</nav>

		<div class="content">
			<h2> Blog List </h2>
			</br>
			<?php 
			if(isset($_SESSION['postSubmit']))
		        {
                	echo "<td width='80' class='center'>" . $_SESSION['postSubmit'] . "</td>";
                	unset($_SESSION['postSubmit']);
        		}

			?>
 			<form action="blogpost.html" method="post">
			<input type="submit" name="submitblog" value="Create New Blog Post" class= "login-button">
			</form>
</html>

<?php


if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

require('authenticate.php');

        $stmt = $con->query('SELECT * FROM blogs ORDER BY blogid DESC');
        if ($stmt->num_rows > 0){
		while($row = $stmt->fetch_assoc()){
            echo '<div>';
                echo '<h1><a href="viewpost.php?id='.$row['blogid'].'">'.$row['subject'].'</a></h1>';
                echo '<p>Posted on '.$row['pdate'].'</p>';
                echo '<p>'.$row['description'].'</p>';
                echo '<p><a href="viewpost.php?id='.$row['blogid'].'">Read More</a></p>';
            echo '</div>';
		}
	}
	else
	{
	 echo "No blog posts";
	}
	
	$con->close();

   

?>
