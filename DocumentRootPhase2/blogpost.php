<?php
    session_start();

    require('authenticate.php');
    if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
    }
    // When form submitted, insert values into the database.
	$username = $_SESSION['username'];
	   
	$pdate = date('Y-m-d');
     
        $subject = stripslashes($_REQUEST['subject']);
        $subject = mysqli_real_escape_string($con, $subject);

        $description = stripslashes($_REQUEST['description']);
        $description = mysqli_real_escape_string($con, $description);

    	$tags = stripslashes($_REQUEST['tags']);
	$tags = mysqli_real_escape_string($con, $tags);
        //$tagsClean = implode(",",$tags);

	$queryCheck = "SELECT pdate FROM `blogs` WHERE pdate='$pdate'";
	$resultDupes = mysqli_query($con, $queryCheck);
        if(mysqli_num_rows($resultDupes) > 2){
                echo "
                    <h3>Posted twice today.</h3>
                    <p class='link'>Click here to see your <a href='blog.php'> blog</a> posts </p>
                    ";
		exit();
        }
	    else
        {

            $queryBlog = "INSERT into `blogs` (subject, description, pdate, created_by)
                        VALUES ('$subject','$description','$pdate', '$username')";
            $result = mysqli_query($con, $queryBlog);

	    $queryBlogID = "SELECT MAX(blogid) FROM `blogs`";
	    $retrieveBlogID = mysqli_query($con,$queryBlogID);

	$stmt = $con->prepare($queryBlogID);
	// In this case we can use the account ID to get the account info.
	//$stmt->bind_param();
	$stmt->execute();
	$stmt->bind_result($blogID);
	$stmt->fetch();
	$stmt->close();
	//echo "$tagsClean";

	    $queryBlogTag = "INSERT into `blogstags`(blogid,tag)
                     VALUES ('$blogID','$tags')";
            $result2 = mysqli_query($con, $queryBlogTag);
	    $_SESSION['postSubmit'] = 'Blog Post Successfully Submitted';
	    header("Location: blog.php");
        }

?>
