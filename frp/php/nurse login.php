<?php
session_start();
    
    $connection = mysqli_connect ("localhost","root","","hms");

    if(isset($_POST['submit']))
    {
       //getting the data from the form
        $username=$_POST['staffid'];
        $password=$_POST['password'];
        
        $find_username_query="select * from nurse where UName='$username'";
        
        
        $query_username=mysqli_query($connection,$find_username_query);
        
        $fetch_username=mysqli_fetch_array($query_username,MYSQLI_NUM);
        
        if($fetch_username)
        {
            $get_user_pass_query="select * from nurse where UName='$username'";
            
            $query_for_passget=mysqli_query($connection,$get_user_pass_query);
            
            $row = mysqli_fetch_assoc($query_for_passget);
            
            if ($password==$row['Password'])
            {
                //echo "Log in successful";
                $_SESSION["username"]=$username;
                header('Location:B1/patient form.html');
            }
            else
            {
                echo "Staff ID and Password mismatch";
                $_SESSION["status"]="Staff ID and Password mismatch";
                header('Location: ../');   
            }
        }
        else
        {
            echo "Please sign up or check login credentials";
            $_SESSION["status"]="Username is not registered.Please sign up or check typed Username";
            //header('Location:../');
        }
        
    }
    else
    {
       echo "<p>Insertion Failed <br/> Some fields are Blank......!!</p>"; 
        $_SESSION['status']="Empty Fields";
        //header('Location:../');
    }
    mysqli_close($connection);
?>