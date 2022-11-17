<?php

session_start();

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
