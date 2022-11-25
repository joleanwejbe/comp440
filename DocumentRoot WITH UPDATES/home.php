<?php

// We need to use sessions, so you should always start sessions using the below code.
//ob_start();
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

if (isset($_POST['btn1'])) {

    echo "<p> List All Blogs With Only Postive Comments </p>";

    $username = $_SESSION['username'];

    $query = 
'SELECT * FROM blogs 
LEFT JOIN (SELECT DISTINCT blogId AS negblogId FROM comments WHERE sentiment = "negative") tmp ON tmp.negblogId = blogs.blogId 
WHERE tmp.negblogId IS NULL;'; 

    $stmt = $con->query($query);

    if ($stmt->num_rows > 0) {

        while ($row = $stmt->fetch_assoc()) {

            echo '<div>';

            echo '<h1><a href="viewpost.php?id=' . $row['blogid'] . '">' . $row['subject'] . '</a></h1>';

            echo '<p>Posted on ' . $row['pdate'] . '</p>';

	    echo '<p>Created by ' . $row['created_by'] . '</p>';

            echo '<p>' . $row['description'] . '</p>';

            echo '<p><a href="viewpost.php?id=' . $row['blogid'] . '">Read More</a></p>';

            echo '</div>';

        }

    }

    $con->close();
    unset($_SESSION['btn1']);
}



if (isset($_POST['btn2'])) {

    echo "<p> List Users with the Most Comments </p> ";

    $query = 
    'SELECT posted_by 
    FROM (SELECT posted_by, rank() OVER(ORDER BY COUNT(*) DESC) AS comment_count_rank 
    FROM comments GROUP BY posted_by) tmp 
    WHERE comment_count_rank = 1;';
    
    $stmt = $con->query($query);

    if ($stmt->num_rows > 0) {

        while ($row = $stmt->fetch_assoc()) {

            echo '<div>';

            echo '<p>' . $row["posted_by"] . '</p>';

            echo '</div>';

        }

    }

    $con->close();
    unset($_SESSION['btn2']);
}


if(isset($_POST['submitUsers']))
{
require("compareUsers.php");
   $user1 = $_SESSION['user1'];
   $user2 = $_SESSION['user2'];

    $query = "SELECT leadername FROM follows 
		WHERE followername='$user1' OR followername='$user2' 
		HAVING COUNT(leadername)>= 2";

$query1 = "SELECT leadername FROM follows
WHERE followername = '$user1' or followername = '$user2'
GROUP BY leadername HAVING COUNT(*) = 2";

    $stmt = $con->query($query1);

    if ($stmt->num_rows > 0) {
        while ($row = $stmt->fetch_assoc()) {
		
            echo '<div>';
            echo '<p> Leader Name: ' . $row["leadername"] . '</p>';
	    echo '<p> Followers: ' . $user1 ." - ". $user2 . '</p>';
            echo '</div>';
        }

    $con->close();
    unset($_SESSION['btn3']);
}
}

if (isset($_POST['btn3'])) {

    	echo "<p> Who's Following Who</p> ";
	$query ='SELECT username FROM users ORDER BY username';
	require("compareUsers.php");
?>
	<form action="" method="POST">
	<label for="user1" required>Select User</label>
        <select name="user1" id="user1">
<?php
	foreach ($con->query($query) as $row){ //Array or records stored in $row
	echo "<option value=$row[username]>$row[username]</option>"; 
	}
?>	
	</select> 
        
	<br>
	<label for="user2" required>Select User</label>
        <select name="user2" id="user2">
<?php
	foreach ($con->query($query) as $row){ //Array or records stored in $row
	echo "<option value=$row[username]>$row[username]</option>"; 
	}
?>

	</select>
	<input type="submit" name="submitUsers" value="Submit Users">
	</form>	
<?php


}




if (isset($_POST['btn4'])) {

    echo "<p> List Users Who Never Posted a Blog</p> ";

    $query=
'SELECT users.username FROM users
LEFT JOIN (SELECT DISTINCT created_by AS blog_author FROM blogs) blogs
ON blogs.blog_author = users.username
WHERE blogs.blog_author IS NULL';

    $stmt = $con->query($query);

    if ($stmt->num_rows > 0) {

        while ($row = $stmt->fetch_assoc()) {

            echo '<div>';

            echo '<p>' . $row["username"] . '</p>';

            echo '</div>';

        }

    }
    $con->close();

    unset($_SESSION['btn4']);

}





if (isset($_POST['btn5'])) {

    echo "<p> Users with Blogs that have no Negative Comments </p>";

    $query = 
    'SELECT blogs.created_by
    FROM blogs
    JOIN (SELECT blogid, SUM(CASE WHEN sentiment = "negative" THEN 1 ELSE 0 END) AS neg_comment_count FROM comments GROUP BY blogid) AS tmp
    ON tmp.blogid = blogs.blogid 
    GROUP BY blogs.created_by
    HAVING SUM(neg_comment_count) = 0
    ';

    $stmt = $con->query($query);

    if ($stmt->num_rows > 0) {

        while ($row = $stmt->fetch_assoc()) {
            echo '<div>';
            echo '<p>' . $row["created_by"] . '</p>';
            echo '</div>';
        }

    }
    $con->close();

    unset($_SESSION['btn5']);

}



if (isset($_POST['btn6'])) {

    echo "<p> Pair of Users with the Same Hobby </p>";

    $query = 
    'SELECT a.username AS user1, b.username AS user2, a.hobby
    FROM hobbies AS a
    JOIN hobbies AS b ON a.hobby = b.hobby AND a.username <> b.username 
    ';

    $stmt = $con->query($query);

    if ($stmt->num_rows > 0) {

        while ($row = $stmt->fetch_assoc()) {

            echo '<div>';

            echo '<p>Hobby ' . $row['hobby'] . '</p>';

	    echo '<p>' . $row["user1"] ." - ". $row["user2"] .  '</p>';

            echo '</div>';

        }

    }
    $con->close();

    unset($_SESSION['btn6']);

}



?>
			<form action="initialtable.php">

                	<input type="submit" value="Initialize database" >

            		</form>


			<form action="" method='post'>			

                <input type="submit" name="btn1" value="List All Blogs With Only Positive Comments" >

                <input type="submit" name="btn2" value="List Users with the Most Comments" >



                <input type="submit" name="btn3" value="Who's Following Who" >
	

		            <input type="submit" name="btn4" value="List Users Who Never Posted a Blog">

			    <input type="submit" name="btn5" value="Users with Blogs that have no Negative Comments" >

			    <input type="submit" name="btn6" value="Pair of Users with the Same Hobby" >
			</form>
		</div>
	</body>
</html>
