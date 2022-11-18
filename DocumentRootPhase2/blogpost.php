<?php
    session_start();

    require('authenticate.php');
    include("function.php");
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

    ////vardan inserting blogtagcode here

    $length = strlen($tags);
        
    $strarre = Returnarrayoftags($tags,$length);

    foreach ($strarre as $valuee) {
      $blogtagidcount= mysqli_fetch_assoc(mysqli_query($con, "select count(*) as total from blogstags")) ;
      $blogtagid= $blogtagidcount["total"]+1;
      $query = "insert into blogstags(blogid,tag) values ('$blogtagid','$valuee')";
      mysqli_query($con, $query);  
         }

    ///vardan above



	    // $queryBlogTag = "INSERT into `blogstags`(blogid,tag)
        //              VALUES ('$blogID','$tags')";
        //     $result2 = mysqli_query($con, $queryBlogTag);
	    $_SESSION['postSubmit'] = 'Blog Post Successfully Submitted';
	    header("Location: blog.php");
        }

?>
