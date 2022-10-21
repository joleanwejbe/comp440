<?php
    include("config.php");
    session_start();
    ini_set("display_errors",0);
    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        //username and password sent from form

        $myusername = mysqli_real_escape_string($db, $_POST['username']);
        $mypassword = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db, $sqli);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active = $row['active'];

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if($count == 1)
        {   
            //session_register("myusername");
            
            $_SESSION['login_user'] = $myusername;
            header("location: welcome.php");
        }
        else{
            $error = "Your Login Name or Password is invalid!";
        }

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