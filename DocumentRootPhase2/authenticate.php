<?php

// Change this to your connection info.
$DATABASE_HOST = '9d86237fac4b'; // this needs to be changed to the mariadb name from docker container
$DATABASE_USER = 'root';
$DATABASE_PASS = 'rootpwd';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
