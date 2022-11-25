<?php
  session_start(); // dont forget it!  

  if(isset($_POST['submitUsers']))
  {
    $_SESSION['user1'] = $_POST['user1']; 
    $_SESSION['user2'] = $_POST['user2']; 

//echo $_SESSION['user1'];
//echo $_SESSION['user2'];

  }
?>
