<?php





/// connections are complete
include("connections.php");
include("function.php");


	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		$user_name = $_POST['user_name'];

		$password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        // attempting to count
        $query = "select count(*) as total from user";
        $result= mysqli_query($con, $query);
        $data= mysqli_fetch_assoc($result);
        //echo $data['total'];
        
		if(!empty($user_name)&& !empty($password)&& !is_numeric($user_name))
		{

             

			$id= $data['total'] +1;
            //$password = password_hash('$password' , PASSWORD_DEFAULT);
			$query = "insert into user(id,username,password,firstName,lastName,email) values ('$id','$user_name','$password','$fname','$lname','$email')";
			mysqli_query($con, $query);
			
			header("Location: index.html");
			die; 
		}
		else
		{

			echo "Please enter something valid";
		}
	}


    
?>

<!DOCTYPE html>
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
                        <label>UserName: </label><input type = 'text' name = 'user_name' class = 'box'/><br /><br />
                        <label>Password: </label><input type = 'text' name = 'password' class = 'box'/><br /><br />
                        <label>FirstName: </label><input type = 'text' name = 'fname' class = 'box'/><br /><br />
                        <label>LastName: </label><input type = 'text' name = 'lname' class = 'box'/><br /><br />
                        <label>Email: </label><input type = 'text' name = 'email' class = 'box'/><br /><br />
                        <input type = "submit" value = "Submit"/>
                    </form>

                    
                    
                </div>
            </div>
        </div>
    </body>
</html>