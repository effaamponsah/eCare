<?php
session_start();
    
    $connection = mysqli_connect ("localhost","root","","hms");

    if(isset($_POST['submit']))
    {
       //getting the data from the form
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        $find_username_query="select * from staff where UName='$username'";
        
        
        $query_username=mysqli_query($connection,$find_username_query);
        
        $fetch_username=mysqli_fetch_array($query_username,MYSQLI_NUM);
        
        if($fetch_username)
        {
            $get_user_pass_query="select * from staff where UName='$username'";
            
            $query_for_passget=mysqli_query($connection,$get_user_pass_query);
            
            $row = mysqli_fetch_assoc($query_for_passget);
            
            if ($password==$row['Password'])
            {
                //echo "Log in successful";
                $_SESSION["username"]=$username;

                $first_char = $username[0];
                //fetches the first character based on the staff and does a rpote
                echo $first_char;

                if ($first_char == 'N') {
                header('Location:../../B1');  
                die(); 
                }
                else {
                header('Location: ../../doc.html');
                die();
                }
                // $first_char = ('N') ? header('Location:../../B1' ) : header('Location: ../../doc.html');


                // header('Location:../../B1');
                // die();
            }
            else
            {
                echo "Username and Password mismatch";
                $_SESSION["status"]="Username and Password mismatch";
                header('Location: ../');   
            }
        }
        else
        {
            echo "Username is not registered.Please sign up or check typed Username";
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