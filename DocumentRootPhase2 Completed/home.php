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
				<a href="home.php"><h1> COMP 440 Database Design Fall 2022</h1></a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="blog.php"><i class="fas fa-newspaper"></i>Blog</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>


<?php
require("authenticate.php");



if(isset($_POST['btn1'])){
echo "<p> List All Blogs Created by " .$_SESSION['username'] . ".</p>";
$username = $_SESSION['username'];
$query = 'SELECT blogs.*, comments.sentiment FROM blogs, comments WHERE blogs.created_by="$username" AND blogs.blogid = comments.blogid AND (comments.sentiment= "positive")';
//$stmt2 = $con->prepare($query);
$stmt = $con->query($query);
        

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

$con->close();
unset($_SESSION['btn1']);
//exit();
}

if(isset($_POST['btn2'])){
echo "List Users with the Most Comments";
unset($_SESSION['btn2']);
}

if(isset($_POST['btn3'])){
echo "Who's Following Who";

unset($_SESSION['btn3']);
}

if(isset($_POST['btn4'])){
echo "List Users Who Never Posted a Blog";

unset($_SESSION['btn4']);
}


if(isset($_POST['btn5'])){
echo "Users with Blogs that have no Negative Comments";

unset($_SESSION['btn5']);
}

if(isset($_POST['btn6'])){
echo "Pair of Users with the Same Hobby";

unset($_SESSION['btn6']);
}


?>

			<form action="initialtable.php">
                	<input type="submit" value="Initialize database" >
            		</form>
			
			<form action="" method='post'>			
                        <input type="submit" name="btn1" value="List All Blogs Created by User" >
                        <input type="submit" name="btn2" value="List Users with the Most Comments" >
                        <input type="submit" name="btn3" value="Who's Following Who" >
                        <input type="submit" name="btn4" value="List Users Who Never Posted a Blog">
			<input type="submit" name="btn5" value="Users with Blogs that have no Negative Comments" >
			<input type="submit" name="btn6" value="Pair of Users with the Same Hobby" >
			</form>



		</div>
	</body>
</html>
