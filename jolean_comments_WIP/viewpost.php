<!DOCTYPE HTML>  
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

<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

require('authenticate.php');
?>

<?php 
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
?>

<?php
// comment form sanitize 
$sentiment = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sentiment = test_input($_POST["sentiment"]);
  $comment = test_input($_POST["comment"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Comment</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Sentiment:
  <input type="radio" name="sentiment" value="positive">Positive
  <input type="radio" name="sentiment" value="negative">Negative
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
// temporary- display input
echo "<h2>Your Input:</h2>";
echo $sentiment;
echo "<br>";
echo "<br>";
echo $comment;
?>

<?php
	// display existing comments
	echo "<h3>All Comments:</h2>";
	$sql = "SELECT * FROM comments WHERE blogid=$id ORDER BY cdate";
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

	
	// comment form

	$con->close();
?>


</body>
</html>
