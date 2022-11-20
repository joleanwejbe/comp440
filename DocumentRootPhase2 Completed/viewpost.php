<?php
ob_start();
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

require('authenticate.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
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
			<h2>Blog Post</h2>
<?php
$id = $_GET['id']; // Collect data from query string

// display the blog
$sql = "SELECT * FROM blogs WHERE blogid=$id";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<h1>' . $row['subject'] . '</a></h1>';
        echo '<p>Blog id: ' . $row['blogid'] . '</p>';
        echo '<p>Author: ' . $row['created_by'] . '</p>';
        echo '<p>Date: ' . $row['pdate'] . '</p>';
        echo '<p>' . $row['description'] . '</p>';
        echo '</div>';
    }
} else {
    echo "<div>No blog posts</div>";
}
?>

<?php 

if((isset($_POST["sentiment"])) OR (isset($_POST["description"]))) {

$cdate = date('Y-m-d');
$username = $_SESSION['username'];
$blogid = $id;
$sentiment = $_POST["sentiment"];
$description = $_POST["description"];
//echo "$cdate";
//echo "$posted_by";
//echo "$blogid";
//echo "$sentiment";
$errorFlag = FALSE;

// user can't comment on their own blog
$queryCheck = "SELECT blogid FROM blogs WHERE created_by = '$username' AND blogid ='$blogid'";
$resultCheck = mysqli_query($con, $queryCheck);

// user can give at most 3 comments a day
$queryComments = "SELECT cdate FROM comments WHERE cdate = '$cdate' AND posted_by ='$username'";
$resultComments = mysqli_query($con, $queryComments);

// At most one comment for each blog
$queryOneComments = "SELECT blogid FROM comments WHERE posted_by = '$username' AND blogid = '$blogid'";
$resultOneComments = mysqli_query($con, $queryOneComments);

if(mysqli_num_rows($resultCheck) > 0 OR mysqli_num_rows($resultComments) >2 OR mysqli_num_rows($resultOneComments) > 0)

{
$_SESSION["invalidMessage"] = "Error: Cannot Add Comment";
$errorFlag = TRUE;
}



if(!$errorFlag){
$queryInsert = "INSERT into comments (sentiment, description, cdate,blogid,posted_by) VALUES ('$sentiment','$description','$cdate', '$blogid', '$username')";
$result = mysqli_query($con, $queryInsert);
if(!$result)
{
echo mysqli_error($con);

}

}

unset($_SESSION["description"]);
unset($_SESSION["sentiment"]);


}


?>

<?php
// display existing comments
echo "<h2>Comments</h2>";
$sql = "SELECT * FROM comments WHERE blogid=$id ORDER BY cdate";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<h1>' . $row['sentiment'] . '</a></h1>';
        echo '<p>Comment id: ' . $row['commentid'] . '</p>';
        echo '<p>Author: ' . $row['posted_by'] . '</p>';
        echo '<p>Date: ' . $row['cdate'] . '</p>';
        echo '<p>' . $row['description'] . '</p>';
        echo '</div>';
    }
} else {
    echo "<div>No comments</div>";
}

?>

<h2>Add Your Comment</h2>

<div>
<form method="post" action="">
  
<?php 
if(isset($_SESSION["invalidMessage"])){
echo '<p>' ;
echo $_SESSION["invalidMessage"]; 
echo '</p>';
unset($_SESSION["invalidMessage"]);

}
?>
	<label for="sentiment" required>Sentiment</label>
	<select name="sentiment" id="sentiment">
        <option value="positive">Positive</option>
        <option value="negative">Negative</option>
	</select>

<br>
<br>
 <textarea style="resize:none" name="description" placeholder= "Enter your thoughts here" required= ""></textarea>
  <input type="submit" name="submit" value="Submit" placeholder="Submit Comment">
</form>
</div>

</body>
</html>
