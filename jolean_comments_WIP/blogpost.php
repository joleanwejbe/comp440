
<?php
    require('authenticate.php');

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes

	$pdate = date('Y-m-d');
    	$currentuser = $_SESSION['name'];

        $subject = stripslashes($_REQUEST['subject']);
        $subject = mysqli_real_escape_string($con, $subject);

        $description = stripslashes($_REQUEST['description']);
        $description = mysqli_real_escape_string($con, $description);

	$tags = stripslashes($_REQUEST['tags']);
        //escapes special characters in a string
        $tags = mysqli_real_escape_string($con, $tags);


	$queryCheck = "SELECT COUNT(pdate) FROM `blogs` WHERE pdate='$pdate' ";
	$resultDupes = mysqli_query($con, $queryCheck);
	

	
	if(mysqli_num_rows($resultDupes) == 2){
            echo "
                  <h3>Invalid input.</h3>
                  <p class='link'>Click here to <a href='blogpost.html'>resubmit blog post</a> again </p>
                  ";

	}
	else{

        $queryBlog    = "INSERT into `blogs` (blogid, subject, description, pdate, created_by)
                     VALUES (DEFAULT, '$subject','$description','$pdate', '$currentuser')";
        $result   = mysqli_query($con, $queryBlog);

        if ($result) {

            echo "
                  <h3>Blog post submitted successfully.</h3>
                  <p class='link'>Click here to <a href='blog.php'>view</a> your blog posts.>

                ";
                 
        }


	$queryBlogTag = "INSERT into `blogstags`(tag)
                     VALUES (DEFAULT,'$tags')";

        $result = my_sqli_query($con, $queryBlogTag);

	if ($result) {

            echo "
                  <h3>Blog post submitted successfully.</h3>
                  <p class='link'>Click here to <a href='blog.php'>view</a> your blog posts.</p>
                  
		";        	 
	} 
 
}
}
?>
