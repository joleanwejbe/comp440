<?php
    include("config.php");
    session_start();
    ini_set("display_errors",0);

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //username and password sent from form

        $myusername = mysqli_real_escape_string($db, $_POST['username']);
        $mypassword = mysqli_real_escape_string($db, $_POST['password']);
        $myfname = mysqli_real_escape_string($db, $_POST['fname']);
        $mylname = mysqli_real_escape_string($db, $_POST['lname']);
        $myemail = mysqli_real_escape_string($db, $_POST['email']);
        
        // $sqlInsert = "INSERT INTO user VALUES {'" + $myusername + "','"+ $mypassword+ "'+;
        // $result = mysqli_query($db, $sqlInsert);

        // // if result matched $myusername and $mypassword, table row must be 1 row

        // if($result == true)
        // {
        //     $msg = "The new user is added successfully!";
        // }
        // else
        // {
        //     $msg = "Your input information is not correct. Try again!";
        // }
    }
?>

<html>
    <head>
        <title> Login Page </title>
        <style type = "text/css">
            body{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
            }

            label{
                font-weight: bold;
                width: 100px;
                font-size: 14px;
            }
            .box {
                border: #666666 solid 1px;

            }

        </style>
    </head>

    <body bgcolor = "#FFFFFF">
        <div align = "center">
            <div style = "width:300px ; border: solid 1px #333333; " align = "left">
                <div style = "background-color:n  #333333; color: #FFFFFF; padding: 3px;"><b>Login</b></div>

                <div style = "margin:30px">

                    <form action = "" method = "post">
                        <label>UserName: </label><input type = 'text' name = 'username' class = 'box'/><br /><br />
                        <label>Password: </label><input type = 'text' name = 'password' class = 'box'/><br /><br />
                        <label>FirstName: </label><input type = 'text' name = 'fname' class = 'box'/><br /><br />
                        <label>LastName: </label><input type = 'text' name = 'lname' class = 'box'/><br /><br />
                        <label>Email: </label><input type = 'text' name = 'email' class = 'box'/><br /><br />
                        <input type = "submit" value = "Submit"/>
                    </form>

                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $msg; ?></div>
                    
                </div>
            </div>
        </div>
    </body>
</html>

