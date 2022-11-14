<?php 
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

include("authenticate.php");// after this connections are established 
// these are my custom function, feel free to add to them for your parts and just do include
include("function.php");

// if button was pressed 
if($_SERVER['REQUEST_METHOD']== "POST")
{   
    
    
    // this is our currentdate
    $date = date('Y-m-d');
    $currentuser = $_SESSION['name'];
    $query = "SELECT *  FROM blogs WHERE '$date' LIKE pdate";
    $DatesnNames = mysqli_fetch_all(mysqli_query($con, $query), MYSQLI_ASSOC);
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $blogtag = $_POST['tags'];
    if(CanIPostABlog($DatesnNames,$currentuser))
    {  if(isset($subject, $description, $blogtag)){
        $blogidcount= mysqli_fetch_assoc(mysqli_query($con, "select count(*) as total from blogs")) ;
        $blogtagidcount= mysqli_fetch_assoc(mysqli_query($con, "select count(*) as total from blogstags")) ;
        //All data in textboxes
        $blogid = $blogidcount["total"] +1;
       
        $blogtagid= $blogtagidcount["total"]+1;
        $pdate = $date;
        $createdby = $currentuser;
        
        $query = "insert into blogs(blogid,subject,description,pdate,created_by) values ('$blogid','$subject','$description','$pdate','$createdby')";
        mysqli_query($con, $query);

        $query = "insert into blogstags(blogid,tag) values ('$blogid','$blogtag')";
        mysqli_query($con, $query);   
        header('Location: home.php');     
    }
    }
    else
    {

        echo "
        <h3>You have allready posted twice today..</h3>
        <p class='link'>Click here to return to home page <a href='home.php'>home</a> again </p>
         the current date based on the server is ";
        echo $date; 
       
    }
}




?>






<!DOCTYPE html>
<html lang="en">
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}

</style>
</head>
<body>





<!-- Page content -->
<div class="w3-content" style="max-width:100%; max-height:100%; ">

  

  
  <div class="w3-black" id="tour">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">Register your current blogs</h2>
      <p class="w3-opacity w3-center"><i>You can return to the home page with the button below user </i></p><br>

      <ul class="w3-ul w3-border w3-white w3-text-grey">
      <form  method="post">  
      <li class="w3-padding">Subject <span class="w3-tag w3-red w3-margin-left"></span></li>
      <input type="text"  class="login-input" name="subject"  placeholder="Enter Subject here"required  />  
      <li class="w3-padding">Description <span class="w3-tag w3-red w3-margin-left"></span></li>
      <input type="text" style="height: 50px;" size="80" class="login-input" name="description" placeholder="Enter a detailed description here"required  />

      <li class="w3-padding">Tags <span class="w3-badge w3-right w3-margin-right"></span></li>
        
                               

      <input type="text" class="login-input" name="tags" placeholder="Enter tags here " required />  
      <input  type="submit" name="submit" value="Register Blog" class="BlogSubmission">  
      </form>
      </ul>

      

      </div>
    </div>
  </div>

  
  
<!-- End Page Content -->
</div>




</body>
</html>
