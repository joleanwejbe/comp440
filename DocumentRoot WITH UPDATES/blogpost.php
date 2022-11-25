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
        $tags = str_replace('.','',$tags);
	//echo "$tags"
	$tagsClean = explode(",",$tags);

	$queryCheck = "SELECT pdate FROM `blogs` WHERE pdate='$pdate'AND created_by='$username'";
	$resultDupes = mysqli_query($con, $queryCheck);
        if(mysqli_num_rows($resultDupes) > 1){
                
		$_SESSION['postSubmit'] = "Posted twice today. Maximum post limit reached.";
		header("Location: blog.php");
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

	foreach($tagsClean as $tag)
	{
		$stmt = $con->query('SELECT * FROM blogstags WHERE tag=$tag');

		if ($stmt->num_rows == 0){
	    	$queryBlogTag = "INSERT into `blogstags`(blogid,tag)
                     VALUES ('$blogID','$tag')";
            	$result2 = mysqli_query($con, $queryBlogTag);
	
		}
	} 
	   $_SESSION['postSubmit'] = 'Blog Post Successfully Submitted';
	    header("Location: blog.php");
        }

?>
