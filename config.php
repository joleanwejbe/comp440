<?php
    define('DB_SERVER','localhost:3306');
    define('DB_USERNAME','[NEED TO CHANGE]');
    define('DB_PASSWORD','[NEED TO CHANGE]');
    define('DB_DATABASE','[NEED TO CHANGE]');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    //check connection
    if($db == false)
    {
        die("ERROR: Could not connect. ", mysqli_connect_error());

    }


?>