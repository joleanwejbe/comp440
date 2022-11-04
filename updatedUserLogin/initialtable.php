<?php 
include("connections.php");
//drops table
// Create database
$sql = "";
$query = "Drop Table user";
mysqli_query($con, $query);



$query = " CREATE TABLE IF NOT EXISTS user (
    id int(11) NOT NULL AUTO_INCREMENT,
      username varchar(50) NOT NULL,
      password varchar(255) NOT NULL,
    firstName varchar(100) NOT NULL,
    lastName varchar(100) NOT NULL,
      email varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

";

mysqli_query($con, $query);


$query = "INSERT INTO user (`id`, `username`, `password`, `firstName`, `lastName`, `email`) VALUES (1, 'test', 'test', 'firstTest', 'lastTest', 'test@test.com'); ";
mysqli_query($con, $query);


header('Location: home.php');